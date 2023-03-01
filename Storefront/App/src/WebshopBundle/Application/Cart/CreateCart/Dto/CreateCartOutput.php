<?php

namespace App\WebshopBundle\Application\Cart\CreateCart\Dto;

class CreateCartOutput
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
