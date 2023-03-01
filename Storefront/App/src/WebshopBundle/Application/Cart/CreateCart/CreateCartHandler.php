<?php

namespace App\WebshopBundle\Application\Cart\CreateCart;

use App\WebshopBundle\Application\Cart\CreateCart\Dto\CreateCartOutput;
use App\WebshopBundle\Domain\Model\Cart\CartRepositoryInterface;

class CreateCartHandler
{

    public function __construct(
        private CartRepositoryInterface $cartRepository
    )
    {
    }

    public function __invoke(CreateCartCommand $command): CreateCartOutput
    {
        $cart = $this->cartRepository->createCart();
        return new CreateCartOutput($cart->getId());
    }
}