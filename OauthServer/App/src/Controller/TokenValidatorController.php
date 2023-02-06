<?php

namespace App\Controller;

use DateTimeZone;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Exception;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function dd;
use function str_replace;

class TokenValidatorController extends AbstractController
{

    public function __construct(
        private string $publicKeyPath
    )
    {
    }

    #[Route(path: "/token/validate", name: 'app_token_validate', methods: ['POST'])]
    public function validateToken(
        Request $request,
        AccessTokenRepositoryInterface $accessTokenRepository,
    ): JsonResponse
    {

        $authorizationHeader = $request->get('authorization');

        if (!$authorizationHeader) {
            return new JsonResponse([
                "active" => false,
                "error" => 'Missing authorization'
            ], 401);
        }

        $jwt = \trim((string) \preg_replace('/^\s*Bearer\s/', '', $authorizationHeader));

        $jwtConfiguration = @$this->getConfiguration();

        try {
            // Attempt to parse the JWT
            $token = $jwtConfiguration->parser()->parse($jwt);
        } catch (Exception $exception) {
            return new JsonResponse([
                "active" => false,
                "error" => $exception->getMessage()
            ], 403);
        }

        try {
            // Attempt to validate the JWT
            $constraints = $jwtConfiguration->validationConstraints();
            $jwtConfiguration->validator()->assert($token, ...$constraints);
        } catch (RequiredConstraintsViolated $exception) {
            return new JsonResponse([
                "active" => false,
                "error" => 'Access token could not be verified'
            ], 403);
        }

        $claims = $token->claims();

        if ($accessTokenRepository->isAccessTokenRevoked($claims->get('jti'))) {
            return new JsonResponse([
                "active" => false,
                "error" => 'Access token has been revoked'
            ], 403);
        }

        return new JsonResponse([
            "active" => true,
            "error" => ''
        ], 200);
    }

    /**
     * @return Configuration
     */
    private function getConfiguration(): Configuration
    {

        $publicKey = new CryptKey($this->publicKeyPath);
        $jwtConfiguration = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('empty', 'empty')
        );

        $jwtConfiguration->setValidationConstraints(
            \class_exists(LooseValidAt::class)
                ? new LooseValidAt(new SystemClock(new DateTimeZone(\date_default_timezone_get())))
                : new ValidAt(new SystemClock(new DateTimeZone(\date_default_timezone_get()))),
            new SignedWith(
                new Sha256(),
                InMemory::plainText($publicKey->getKeyContents(), $publicKey->getPassPhrase() ?? '')
            )
        );
        return $jwtConfiguration;
    }
}