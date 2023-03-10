<?php


namespace App\Application;


use App\Domain\Cart;
use App\Domain\CartRepository;
use App\Domain\ProductRepository;

class CreateCartCommandHandler
{

    protected CartRepository $cartRepository;
    protected ProductRepository $productRepository;

    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }
    public function __invoke(CreateCartCommand $command)
    {
        $cart = new Cart(
            $this->cartRepository->nextIdentity(),
            $command->getCustomerIdentifier()
        );

        foreach ($command->getItems() as $item){
            $product = $this->productRepository->findBySku($item->getSku());
            $price = $product->getPrice($command->getCustomerIdentifier());
            $cart->addItem($item->getSku(),$item->getQuantity(),$price);
        }

        $this->cartRepository->add($cart);

        $response = new CreateCartCommandResponse($cart->getId(),$cart->getCustomerIdentifier(),$cart->getTotal());
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