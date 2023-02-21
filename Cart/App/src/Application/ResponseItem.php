<?php


namespace App\Application;


class ResponseItem
{
    protected $id;

    protected $sku;

    protected $quantity;

    protected $price;

    protected $total;


    public function __construct(string $id, $sku,$quantity,$price, $total)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total = $total;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getTotal()
    {
        return $this->total;
    }
}