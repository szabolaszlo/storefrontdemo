<?php


namespace App\Application;


class DeleteCartCommand
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