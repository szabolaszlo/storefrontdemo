<?php

namespace App\Application\GetCheckoutPaymentMethodList;

use App\Domain\ShippingMethodId;
use App\Infrastructure\Persistence\Doctrine\GetCheckoutPaymentMethodListQueryService\GetCheckoutPaymentMethodListQueryService;

class Handler
{
    private GetCheckoutPaymentMethodListQueryService $queryService;

    public function __construct(GetCheckoutPaymentMethodListQueryService $queryService)
    {
        $this->queryService = $queryService;
    }

    public function handle(Query $query): array
    {
        $paymentMethods = $this
            ->queryService
            ->getCheckoutPaymentMethodListByShippingMethodId(
                new ShippingMethodId($query->getShippingId())
            );

        $responsePaymentMethods = ['paymentMethods' => []];

        foreach ($paymentMethods as $paymentMethod){
            $responsePaymentMethods['paymentMethods'] = [
                'id' => $paymentMethod->getId()->getId(),
                'name' => $paymentMethod->getName(),
                'description' => $paymentMethod->getDescription(),
                'fee' => $paymentMethod->getFee(),
            ];
        }

        return $responsePaymentMethods;
    }
}
