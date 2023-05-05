<?php

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\Payment;
use App\Domain\PaymentId;
use App\Domain\PaymentMethodId;

class PaymentRepository implements \App\Domain\PaymentRepositoryInterface
{

    public function get(PaymentId $id): Payment
    {

            $testPayment = new Payment();
            $testPayment->setPaymentId(
               $id
            );
            $testPayment->setPaymentMethodId(
                new PaymentMethodId('test method id')
            );
            $testPayment->setCustomer(
                [
                    'email'=> 'test@test.com',
                    'billingAddress' => []
                ]
            );

            $testPayment->setAmount(11.0);
            $testPayment->setStatus('SUCCESS');
            $testPayment->setRedirectUrl('redirect url');

            return $testPayment;

    }
}
