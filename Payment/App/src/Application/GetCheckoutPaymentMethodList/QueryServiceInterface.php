<?php

namespace App\Application\GetCheckoutPaymentMethodList;

use App\Domain\ShippingMethodId;

interface QueryServiceInterface
{
    public function getCheckoutPaymentMethodListByShippingMethodId(ShippingMethodId $id): array;
}
