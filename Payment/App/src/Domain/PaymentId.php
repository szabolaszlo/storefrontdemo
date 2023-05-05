<?php

namespace App\Domain;



class PaymentId
{
    private $id;

    public function __construct(string $id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }
}
