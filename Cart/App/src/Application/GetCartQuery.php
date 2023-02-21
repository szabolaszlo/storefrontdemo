<?php


namespace App\Application;


use function Ramsey\Collection\remove;

class GetCartQuery
{
    protected $cartId;

    public function __construct($cartId)
    {
        $this->cartId = $cartId;
    }

    public function getCartId()
    {
        return $this->cartId;
    }
}