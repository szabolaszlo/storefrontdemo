<?php

namespace App\Presentation\Api\Controller;

use App\Application\CreatePayment\CreatePaymentCommand;
use App\Application\CreatePayment\CreatePaymentHandler;
use App\Application\GetPaymentQuery\GetPaymentHandler;
use App\Application\GetPaymentQuery\GetPaymentQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InitiatePaymentController extends AbstractController
{
    public function index (
        Request $request,
        CreatePaymentHandler $createPaymentHandler,
        GetPaymentHandler $getPaymentHandler
    ): JsonResponse
    {
        return new JsonResponse('ok');

        $paymentId = 'asd';

        // TODO payment method query
        $paymentMethod->getType();


        $createPaymentHandler->execute(
            new CreatePaymentCommand(
                $request->request->get('paymentMethodId', ''),

                $request->request->get('amount', 0.0),

            )
        );

        $payment = $getPaymentHandler->execute(
            new GetPaymentQuery($paymentId)
        );

        return new JsonResponse(
            $payment
        );
    }

}
