<?php


namespace App\Application;


class CommandItem
{
    protected $sku;

    protected $quantity;

    public function __construct($sku,$quantity)
    {
        $this->sku = $sku;
        $this->quantity = $quantity;
    }


    public function getSku()
    {
        return $this->sku;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}