<?php


namespace App\Application;


use App\Application\Exception\ApplicationException;
use App\Domain\Cart;
use App\Domain\CartId;
use App\Domain\CartRepository;

class GetCartQueryHandler
{
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function __invoke(GetCartQuery $query)
    {
        $cart = $this->cartRepository->findById(CartId::create($query->getCartId()));

        if (!$cart) {
            throw new ApplicationException('This cart is not existed: ' . $query->getCartId());
        }

        $response = new GetCartResponse($cart->getId(), $cart->getCustomerIdentifier(), $cart->getTotal());
            foreach ($cart->getItems() as $item) {
                $response->addItem(
                    $item->getId(),
                    $item->getSku(),
                    $item->getQuantity(),
                    $item->getPrice(),
                    $item->getTotal()
                );
            }

        return $response;
    }
}