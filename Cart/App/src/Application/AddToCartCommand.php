<?php


namespace App\Application;


class AddToCartCommand
{
    protected $cartId;

    protected $items;

    public function __construct($cartId)
    {
        $this->cartId = $cartId;
    }

    public function getCartId()
    {
        return $this->cartId;
    }

    public function addItem($sku, $quantity)
    {
        $item = new CommandItem($sku,$quantity);
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }
}