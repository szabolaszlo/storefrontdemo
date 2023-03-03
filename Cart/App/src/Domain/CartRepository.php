<?php


namespace App\Domain;


interface CartRepository
{
    public function nextIdentity();
    public function add(Cart $cart);
    public function remove(Cart $cart);

    public function findById(CartId $id): ?Cart;
}