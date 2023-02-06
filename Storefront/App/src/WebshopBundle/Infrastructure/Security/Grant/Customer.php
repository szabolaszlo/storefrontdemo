<?php
namespace App\WebshopBundle\Infrastructure\Security\Grant;

use League\OAuth2\Client\Grant\Password;

class Customer extends Password
{

    /**
     * @inheritdoc
     */
    protected function getName()
    {
        return 'customer';
    }

}