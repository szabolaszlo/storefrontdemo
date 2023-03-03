<?php


namespace App\Application;


use JsonSerializable;
use function get_object_vars;

class ResponseItem implements JsonSerializable
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

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}