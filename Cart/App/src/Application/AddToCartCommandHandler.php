<?php


namespace App\Application;


use App\Domain\Cart;
use App\Domain\CartId;
use App\Domain\CartRepository;
use App\Domain\ProductRepository;

class AddToCartCommandHandler
{
    protected CartRepository $cartRepository;
    protected ProductRepository $productRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function __invoke(AddToCartCommand $command)
    {

        $cart = $this->cartRepository->findById(CartId::create($command->getCartId()));


        foreach ($command->getItems() as $item){
            $product = $this->productRepository->findBySku($item->getSku());
            $price = $product->getPrice($cart->getCustomerIdentifier());
            $cart->addItem($item->getSku(),$item->getQuantity(),$price);
        }

        $this->cartRepository->add($cart);

        $response = new AddToCartCommandResponse($cart->getId(),$cart->getCustomerIdentifier(),$cart->getTotal());
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