<?php


namespace App\Domain;

class Item
{

    protected $id;

    protected $sku;

    protected $price;

    protected $quantity;

    protected $created;

    public function __construct(ItemId $id, $sku, $quantity, $price)
    {
        $this->id = $id;
        $this->sku = $sku;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->created = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->price * $this->quantity;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function increaseQuantity(int $amount)
    {
        $this->quantity = $this->quantity + $amount;
    }
}