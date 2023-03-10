<?php

namespace App\Domain;

use App\Domain\Specification\CartSpecification;

interface CartRepository
{
    public function nextIdentity();
    public function add(Cart $cart);
    public function remove(Cart $cart);
    public function findById(CartId $id): ?Cart;
    /**
     * @return Cart[]
     */
    public function query(CartSpecification $cartSpecification): array;
}