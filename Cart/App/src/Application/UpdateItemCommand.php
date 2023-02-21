<?php


namespace App\Application;


class UpdateItemCommand
{
    protected $cartId;

    protected $itemId;

    protected $quantity;

    public function __construct($cartId,$itemId,$quantity)
    {
        $this->cartId = $cartId;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
    }

    public function getCartId()
    {
        return $this->cartId;
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}