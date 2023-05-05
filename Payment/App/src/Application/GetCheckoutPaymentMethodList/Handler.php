<?php

namespace App\Application\GetCheckoutPaymentMethodList;

use App\Domain\ShippingMethodId;

class Handler
{

    public function handle(Query $query): array
    {
        new ShippingMethodId($query->getShippingId());
    }
}
