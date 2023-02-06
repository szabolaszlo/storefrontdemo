<?php

namespace App\WebshopBundle\Infrastructure\Security;

use App\WebshopBundle\Infrastructure\Security\Grant\Customer;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class OauthClient
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

        $this->genericProvider->getGrantFactory()->setGrant('customer', new Customer());
    }

    /**
     * @throws IdentityProviderException
     */
    public function getAccessToken($username,$password): AccessTokenInterface
    {
        return $this->genericProvider->getAccessToken('customer',
            [
            'username' => $username,
            'password' => $password
            ]
        );
    }

}