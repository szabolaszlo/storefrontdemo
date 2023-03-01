<?php

namespace App\WebshopBundle\Application\Cart\GetCart\Dto;

use App\WebshopBundle\Domain\Model\Cart\ItemCollection;

class GetCartOutput
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