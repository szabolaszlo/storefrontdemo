<?php

namespace App\WebshopBundle\Domain\Model\Cart;

use App\WebshopBundle\Domain\Exception\DomainException;
use App\WebshopBundle\Domain\Model\Cart\Dto\AddToCartInput;

interface CartRepositoryInterface
{
    public function createCart(): Cart;
    public function addToCart(AddToCartInput $addToCartInput): Cart;

    /**
     * @throws DomainException
     */
    public function getCart(string $cartId): ?Cart;

    /**
     * @throws DomainException
     */
    public function removeItemFromCart(string $cartId, string $itemId): void;
}