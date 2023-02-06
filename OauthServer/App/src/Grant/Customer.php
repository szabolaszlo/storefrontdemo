<?php
namespace App\Grant;

use League\Bundle\OAuth2ServerBundle\AuthorizationServer\GrantTypeInterface;
use League\OAuth2\Server\Grant\PasswordGrant;

class Customer extends PasswordGrant implements GrantTypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'customer';
    }

    public function getAccessTokenTTL(): ?\DateInterval
    {
        return new \DateInterval('PT1H');
    }
}