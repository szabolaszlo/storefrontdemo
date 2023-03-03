<?php

namespace App\WebshopBundle\Application\Cart\RemoveItemFromCart;

class RemoveItemFromCartCommand
{

    public function __construct(
        private string $cartId,
        private string $itemId
    )
    {
    }

    public function getCartId(): string
    {
        return $this->cartId;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }
}
