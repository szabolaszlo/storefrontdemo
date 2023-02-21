<?php


namespace App\Application;


use App\Domain\CartId;
use App\Domain\CartRepository;
use App\Domain\ItemId;

class DeleteItemCommandHandler
{
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function __invoke(DeleteItemCommand $query)
    {
        $cart = $this->cartRepository->findById(CartId::create($query->getCartId()));
        $cart->removeItem(ItemId::create($query->getItemId()));
        $this->cartRepository->add($cart);

        $response = new DeleteItemCommandResponse($cart->getId(),$cart->getCustomerIdentifier(),$cart->getTotal());
        foreach ($cart->getItems() as $item){
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