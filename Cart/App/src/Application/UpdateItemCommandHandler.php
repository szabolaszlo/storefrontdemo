<?php


namespace App\Application;


use App\Domain\CartId;
use App\Domain\CartRepository;
use App\Domain\ItemId;

class UpdateItemCommandHandler
{
    protected CartRepository $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function __invoke(UpdateItemCommand $query)
    {
        $cart = $this->cartRepository->findById(CartId::create($query->getCartId()));
        $cart->changeQuantity(ItemId::create($query->getItemId()),$query->getQuantity());
        $this->cartRepository->add($cart);

        $response = new UpdateItemCommandResponse($cart->getId(),$cart->getCustomerIdentifier(),$cart->getTotal());
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