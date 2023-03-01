<?php

namespace App\WebshopBundle\Domain\Model\Cart;

class Cart
{

    public function __construct(
        private string $id,
        private ?string $customerIdentifier,
        private ItemCollection $items,
        private float $total
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCustomerIdentifier(): ?string
    {
        return $this->customerIdentifier;
    }

    public function getItems(): ItemCollection
    {
        return $this->items;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
}
