<?php


namespace App\Application;


use App\Domain\CartId;
use App\Domain\CartRepository;
use App\Domain\ProductRepository;


class UpdateCustomerIdentifierCommandHandler
{
    protected CartRepository $cartRepository;
    protected ProductRepository $productRepository;


    public function __construct(CartRepository $cartRepository, ProductRepository $productRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function __invoke(UpdateCustomerIdentifierCommand $command)
    {

        $cid = $command->getCustomerIdentifier();
        $cart = $this->cartRepository->findById(CartId::create($command->getCartId()));

        $cart->setCustomerIdentifier($command->getCustomerIdentifier());


        foreach ($cart->getItems() as $item){
            $product = $this->productRepository->findBySku($item->getSku());
            $item->setPrice($product->getPrice($cid));
        }

        $this->cartRepository->add($cart);

        $response = new UpdateCustomerIdentifierCommandResponse($cart->getId(),$cart->getCustomerIdentifier(),$cart->getTotal());
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