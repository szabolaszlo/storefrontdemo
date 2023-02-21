<?php


namespace App\Application;


use App\Domain\CartId;
use App\Domain\CartRepository;

class DeleteCartCommandHandler
{
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function __invoke(DeleteCartCommand $query)
    {
        $cart = $this->cartRepository->findById(CartId::create($query->getCartId()));
        $this->cartRepository->remove($cart);

        return new DeleteCartCommandResponse();
    }
}