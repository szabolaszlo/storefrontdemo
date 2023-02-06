<?php
namespace App\WebshopBundle\Infrastructure\CustomerService;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CustomerTokenProvider implements TokenProviderInterface
{

    public function __construct(
        private TokenStorageInterface $tokenStorage
    )
    {}

    public function getAccessToken()
    {
        return $this->tokenStorage->getToken()->getAttribute('accesstoken');
    }
}