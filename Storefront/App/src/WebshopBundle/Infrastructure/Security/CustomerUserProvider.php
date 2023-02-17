<?php

namespace App\WebshopBundle\Infrastructure\Security;

use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class CustomerUserProvider implements UserProviderInterface
{
    private GenericProvider $genericProvider;

    /** @var AccessToken $accessToken */
    private $accessToken;

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

    private function getAccessToken(){

        if ($this->accessToken){
            if ($this->accessToken->hasExpired()){
                $this->accessToken = $this->genericProvider->getAccessToken('refresh_token', [
                    'refresh_token' => $this->accessToken->getRefreshToken()
                ]);
            }
            return $this->accessToken;
        }

        $this->accessToken = $this->genericProvider->getAccessToken('client_credentials');

        return $this->accessToken;
    }

    /**
     * Symfony calls this method if you use features like switch_user
     * or remember_me.
     *
     * If you're not using these features, you do not need to implement
     * this method.
     *
     * @throws UserNotFoundException if the user is not found
     */
    public function loadUserByIdentifier($identifier): UserInterface
    {
        return $this->getCustomerUser($identifier);
    }

    /**
     * @deprecated since Symfony 5.3, loadUserByIdentifier() is used instead
     */
    public function loadUserByUsername($username): UserInterface
    {
        return $this->loadUserByIdentifier($username);
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof CustomerUser) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }

        return $this->getCustomerUser($user->getUserIdentifier());
    }

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass(string $class): bool
    {
        return CustomerUser::class === $class || is_subclass_of($class, CustomerUser::class);
    }


    /**
     * @param string $identifier
     * @return CustomerUser
     * @throws \App\WebshopBundle\Domain\Exception\DomainException
     */
    private function getCustomerUser(string $identifier): CustomerUser
    {

        $ch = curl_init('http://api_gateway_nginx:8080/customer/api/customers/by_email');
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->getAccessToken()->getToken()
            )
        );
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["email"=>$identifier]));


        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $response = json_decode($response);

        $user = new CustomerUser();
        $user->setEmail($response->email);
        $user->setId($response->id);

        return $user;
    }
}
