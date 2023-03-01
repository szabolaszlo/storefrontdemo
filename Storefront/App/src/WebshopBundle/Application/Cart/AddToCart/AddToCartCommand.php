<?php

namespace App\WebshopBundle\Application\Cart\AddToCart;

class AddToCartCommand
{

    public function __construct(
        private string $cartId,
        private string $sku,
        private int $quantity
    )
    {
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
