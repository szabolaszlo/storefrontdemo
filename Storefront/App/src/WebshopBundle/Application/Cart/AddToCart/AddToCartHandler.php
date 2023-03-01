<?php

namespace App\WebshopBundle\Application\Cart\AddToCart;

use App\WebshopBundle\Application\Cart\AddToCart\Dto\AddToCartOutput;
use App\WebshopBundle\Domain\Model\Cart\CartRepositoryInterface;
use App\WebshopBundle\Domain\Model\Cart\Dto\AddToCartInput;

class AddToCartHandler
{
    public function __construct(
        private CartRepositoryInterface $cartRepository
    )
    {
    }

    public function __invoke(AddToCartCommand $command): AddToCartOutput
    {
        $cart = $this->cartRepository->addToCart(new AddToCartInput(
            $command->getCartId(),
            $command->getSku(),
            $command->getQuantity()
        ));

        return new AddToCartOutput(
            $cart->getId(),
            $cart->getCustomerIdentifier(),
            $cart->getItems(),
            $cart->getTotal()
        );
    }
}