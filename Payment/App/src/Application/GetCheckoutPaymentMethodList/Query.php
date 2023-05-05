<?php

namespace App\Application\GetCheckoutPaymentMethodList;

class Query
{
    private $shippingId;

    /**
     * @param $shippingId
     */
    public function __construct($shippingId)
    {
        $this->shippingId = $shippingId;
    }

    /**
     * @return mixed
     */
    public function getShippingId()
    {
        return $this->shippingId;
    }
}
