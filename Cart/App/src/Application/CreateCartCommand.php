<?php


namespace App\Application;


class CreateCartCommand
{
    protected $customerIdentifier = null;

    protected $items = [];

    public function addItem($sku,$quantity)
    {
        $item = new CommandItem($sku,$quantity);
        $this->items[] = $item;
    }

    public function setCustomerIdentifier($customerIdentifier)
    {
        $this->customerIdentifier = $customerIdentifier;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function getCustomerIdentifier()
    {
        return $this->customerIdentifier;
    }
}