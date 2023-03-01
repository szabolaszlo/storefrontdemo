<?php

namespace App\WebshopBundle\Domain\Model\Cart;

use App\WebshopBundle\Domain\Model\Cart\Dto\AddToCartInput;

interface CartRepositoryInterface
{
    public function createCart(): Cart;
    public function addToCart(AddToCartInput $addToCartInput): Cart;
    public function getCart(string $cartId): Cart;
}