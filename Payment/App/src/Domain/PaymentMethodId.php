<?php

namespace App\Domain;

use Ramsey\Uuid\Uuid;

class PaymentMethodId
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    public function getId()
    {
        return $this->id;
    }
}
