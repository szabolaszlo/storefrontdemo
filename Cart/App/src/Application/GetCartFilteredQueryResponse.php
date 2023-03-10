<?php

namespace App\Application;

class GetCartFilteredQueryResponse
{
    /**
     * @param array<GetCartResponse> $carts
     */
    public function __construct(
        private array $carts
    ) {
    }

    public function getCarts(): array
    {
        return $this->carts;
    }
}