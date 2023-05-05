<?php

namespace App\Application\Service;

use App\Application\DTO\PaymentDTO;

class PaymentRedirectUrlFactory
{
    public function createRedirectUrl(PaymentDTO $paymentDTO): string {
        return '';
    }
}
