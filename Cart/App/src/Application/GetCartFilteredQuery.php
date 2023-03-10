<?php

namespace App\Application;

use DateTimeImmutable;

class GetCartFilteredQuery
{

    public function __construct(
        private DateTimeImmutable $from,
        private DateTimeImmutable $to,
        private $needToBeCustomerIdentified = false
    ) {
    }

    public function from(): DateTimeImmutable
    {
        return $this->from;
    }

    public function to(): DateTimeImmutable
    {
        return $this->to;
    }

    public function getNeedToBeCustomerIdentified(): bool
    {
        return $this->needToBeCustomerIdentified;
    }
}