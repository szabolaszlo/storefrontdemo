<?php

namespace App\EventListener;

use League\Bundle\OAuth2ServerBundle\Event\UserResolveEvent;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserResolveListener
{
    public function __construct(
        private UserProviderInterface $userRepository,
        private UserPasswordHasherInterface $userPasswordHasher
    ) {}

    public function onUserResolve(UserResolveEvent $event): void
    {

        try {
            $user = $this->userRepository->loadUserByIdentifier($event->getUsername());
        } catch (AuthenticationException $e) {
            return;
        }

        if (null === $user || !($user instanceof PasswordAuthenticatedUserInterface)) {
            return;
        }

        if (!$this->userPasswordHasher->isPasswordValid($user, $event->getPassword())) {
            return;
        }

        $event->setUser($user);
    }
}
