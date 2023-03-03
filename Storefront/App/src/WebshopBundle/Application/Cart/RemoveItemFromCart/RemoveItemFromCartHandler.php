<?php

namespace App\WebshopBundle\Application\Cart\RemoveItemFromCart;

use App\WebshopBundle\Application\Cart\Exception\ApplicationException;
use App\WebshopBundle\Domain\Exception\DomainException;
use App\WebshopBundle\Domain\Model\Cart\CartRepositoryInterface;

class RemoveItemFromCartHandler
{

    public function __construct(
        private CartRepositoryInterface $cartRepository
    )
    {
    }

    public function __invoke(RemoveItemFromCartCommand $command)
    {
        try {
            $this->cartRepository->removeItemFromCart(
                $command->getCartId(),
                $command->getItemId()
            );
        } catch (DomainException $e) {
            throw new ApplicationException($e->getMessage(), $e->getCode());
        }
    }
}