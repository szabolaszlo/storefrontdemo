<?php

namespace App\Application;

use App\Domain\CartRepository;
use App\Domain\Specification\CartSpecificationFactory;

class GetCartFilteredHandler
{
    public function __construct(
        private CartRepository $cartRepository,
        private CartSpecificationFactory $cartSpecificationFactory
    ) {
    }

    public function __invoke(GetCartFilteredQuery $query): array
    {
        $andCartSpecification = $this->cartSpecificationFactory->createAnd(
            $this->cartSpecificationFactory->createCartCreatedAtInterval(
                $query->from(),
                $query->to()
            ),

        );

        if ($query->getNeedToBeCustomerIdentified()){
            $andCartSpecification->addCartSpecification(
                $this->cartSpecificationFactory->createHasCartCustomerIdentifier()
            );
        }

        $carts =  $this->cartRepository->query($andCartSpecification);

        $cartResponses = [];
        foreach ($carts as $cart){
            $cartResponses[] = new GetCartResponse(
                $cart->getId(),
                $cart->getCustomerIdentifier(),
                $cart->getCreated()->format('Y-m-d H:i:s')
            );
        }

        return $cartResponses;
    }
}