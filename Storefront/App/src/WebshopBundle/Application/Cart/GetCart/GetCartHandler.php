<?php

namespace App\WebshopBundle\Application\Cart\GetCart;

use App\WebshopBundle\Application\Cart\GetCart\Dto\GetCartOutput;
use App\WebshopBundle\Domain\Model\Cart\CartRepositoryInterface;

class GetCartHandler
{

    public function __construct(
        private CartRepositoryInterface $cartRepository
    )
    {
    }

    public function __invoke(GetCartQuery $query): GetCartOutput
    {
        $cart = $this->cartRepository->getCart($query->getCartId());

        return new GetCartOutput(
            $cart->getId(),
            $cart->getCustomerIdentifier(),
            $cart->getItems(),
            $cart->getTotal()
        );
    }
}
