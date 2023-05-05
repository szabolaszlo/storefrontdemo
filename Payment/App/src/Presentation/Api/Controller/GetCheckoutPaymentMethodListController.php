<?php

namespace App\Presentation\Api\Controller;

use App\Application\GetCheckoutPaymentMethodList\Handler;
use App\Application\GetCheckoutPaymentMethodList\Query;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetCheckoutPaymentMethodListController extends AbstractController
{
    public function index($shippingMethodId, Handler $handler)
    {
        return new JsonResponse(
            $handler->handle(
                new Query($shippingMethodId)
            )
        );
    }
}
