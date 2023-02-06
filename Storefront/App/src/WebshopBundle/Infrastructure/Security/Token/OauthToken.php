<?php
namespace App\WebshopBundle\Infrastructure\Security\Token;

use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\User\UserInterface;

class OauthToken extends AbstractToken
{

    public function __construct(UserInterface $user, $accesstoken)
    {
        $this->setAttribute('accesstoken',$accesstoken);
        parent::__construct($user->getRoles());
        $this->setUser($user);
        $this->setAuthenticated(true);
    }


    public function getCredentials()
    {
        return $this->getAttribute('accesstoken');
    }
}