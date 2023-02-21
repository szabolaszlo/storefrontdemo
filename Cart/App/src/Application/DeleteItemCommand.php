<?php


namespace App\Application;


class DeleteItemCommand
{
    protected $cartId;

    protected $itemId;

    public function __construct($cartId,$itemId)
    {
        $this->cartId = $cartId;
        $this->itemId = $itemId;
    }

    public function getCartId()
    {
        return $this->cartId;
    }

    public function getItemId()
    {
        return $this->itemId;
    }
}