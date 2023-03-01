<?php

namespace App\WebshopBundle\Application\Cart\GetCart;

class GetCartQuery
{

    public function __construct(
        private string $cartId
    )
    {
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }
}
