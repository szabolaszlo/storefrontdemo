<?php


namespace App\Application;


class UpdateCustomerIdentifierCommand
{

    protected $customerIdentifier = null;

    protected $cartId;

    public function __construct($cartId)
    {
        $this->cartId = $cartId;
    }

    public function setCustomerIdentifier($customerIdentifier)
    {
        $this->customerIdentifier = $customerIdentifier;
    }

    public function getCustomerIdentifier()
    {
        return $this->customerIdentifier;
    }

    public function getCartId()
    {
        return $this->cartId;
    }
}