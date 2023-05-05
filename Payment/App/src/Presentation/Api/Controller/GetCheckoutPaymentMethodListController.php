<?php

namespace App\Presentation\Api\Controller;

use App\Application\GetCheckoutPaymentMethodList\Handler;
use App\Application\GetCheckoutPaymentMethodList\Query;

class GetCheckoutPaymentMethodListController
{
    public function index($shippingMethodId, Handler $handler)
    {
        $handler->handle(
            new Query($shippingMethodId)
        );
    }
}
