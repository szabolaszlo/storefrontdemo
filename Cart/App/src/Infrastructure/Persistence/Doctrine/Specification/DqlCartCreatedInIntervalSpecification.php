<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use DateTimeImmutable;
use Doctrine\Common\Collections\Criteria;

class DqlCartCreatedInIntervalSpecification implements DqlCartSpecification
{
    public function __construct(
        private DateTimeImmutable $from,
        private DateTimeImmutable $to
    )
    {
    }

    public function toDqlCriteria(): Criteria
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->gte('created', $this->from))
            ->andWhere(Criteria::expr()->lte('created', $this->to));
    }
}