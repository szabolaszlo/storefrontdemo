<?php

namespace App\WebshopBundle\Application\Cart\Exception;

class CartNotFoundException extends ApplicationException
{
    public function __construct(string $cartId)
    {
        parent::__construct("Cart not found: {$cartId}", 401);
    }

}