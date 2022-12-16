<?php

namespace App\WebshopBundle\Infrastructure\Security;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class ClientCredentialsOauthClient
{
    private GenericProvider $genericProvider;

    public function __construct(
        string $clientId,
        string $clientSecret,
        string $urlAccessToken
    ) {
        $this->genericProvider = new GenericProvider([
            'clientId'                => $clientId,    // The client ID assigned to you by the provider
            'clientSecret'            => $clientSecret,    // The client password assigned to you by the provider
            'redirectUri'             => null,
            'urlAuthorize'            => null,
            'urlAccessToken'          => $urlAccessToken,
            'urlResourceOwnerDetails' => null
        ]);
    }

    /**
     * @throws IdentityProviderException
     */
    public function getAccessToken(): AccessTokenInterface
    {
        return $this->genericProvider->getAccessToken('client_credentials');
    }

    /**
     * @throws IdentityProviderException
     */
    public function refreshAccessToken(AccessTokenInterface $existingAccessToken): ?AccessTokenInterface
    {
        if (!$existingAccessToken->hasExpired()) {
            return null;
        }

        $newAccessToken = $this->genericProvider->getAccessToken('refresh_token', [
            'refresh_token' => $existingAccessToken->getRefreshToken()
        ]);

        return $newAccessToken;
    }
}