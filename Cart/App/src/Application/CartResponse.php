<?php


namespace App\Application;


abstract class CartResponse
{
    protected $id;
    protected $customerIdentifier;
    protected $items = [];
    protected $total;

    public function __construct(string $id, $customerIdentifier,$total)
    {
        $this->id = $id;
        $this->customerIdentifier = $customerIdentifier;
        $this->total = $total;
    }

    public function addItem($id, $sku,$quantity,$price,$total)
    {
        $item = new ResponseItem($id, $sku,$quantity,$price,$total);
        $this->items [] = $item;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCustomerIdentifier()
    {
        return $this->customerIdentifier;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getTotal()
    {
        return $this->total;
    }
}