<?php

namespace App\WebshopBundle\Domain\Cart\Exception;

use App\WebshopBundle\Domain\Exception\DomainException;

class CartNotfoundException extends DomainException
{
    public function __construct(string $cartId)
    {
        parent::__construct("Cart not found: {$cartId}", 401);
    }
}