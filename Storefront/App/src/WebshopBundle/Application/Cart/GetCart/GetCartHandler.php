<?php

namespace App\WebshopBundle\Application\Cart\GetCart;

use App\WebshopBundle\Application\Cart\Exception\ApplicationException;
use App\WebshopBundle\Application\Cart\Exception\CartNotFoundException;
use App\WebshopBundle\Application\Cart\GetCart\Dto\GetCartOutput;
use App\WebshopBundle\Domain\Exception\DomainException;
use App\WebshopBundle\Domain\Model\Cart\CartRepositoryInterface;

class GetCartHandler
{

    public function __construct(
        private CartRepositoryInterface $cartRepository
    )
    {
    }

    public function __invoke(GetCartQuery $query): GetCartOutput
    {
        try {
            $cart = $this->cartRepository->getCart($query->getCartId());
        } catch (DomainException $exception) {
            throw new ApplicationException($exception->getMessage(), $exception->getCode());
        }

        if (!$cart) {
            throw new CartNotFoundException($query->getCartId());
        }

        return new GetCartOutput(
            $cart->getId(),
            $cart->getCustomerIdentifier(),
            $cart->getItems(),
            $cart->getTotal()
        );
    }
}
