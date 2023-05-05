<?php

namespace App\Domain;

use Ramsey\Uuid\Uuid;

class PaymentId
{
    private $id;

    private function __construct($id = null)
    {
        $this->id = $id ?: Uuid::uuid4()->toString();
    }

    public function getId() {
        return $this->id;
    }
}
