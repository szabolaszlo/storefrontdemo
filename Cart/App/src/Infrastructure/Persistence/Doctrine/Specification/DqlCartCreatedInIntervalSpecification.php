<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use App\Domain\Specification\CartSpecification;
use App\Domain\Specification\CriteriaInterface;
use DateTimeImmutable;

class DqlCartCreatedInIntervalSpecification implements CartSpecification
{
    public function __construct(
        private DateTimeImmutable $from,
        private DateTimeImmutable $to
    ) {
    }

    public function toCriteria(): CriteriaInterface
    {
        return DoctrineCriteria::create()
            ->andWhere(DoctrineCriteria::expr()->gte('created', $this->from))
            ->andWhere(DoctrineCriteria::expr()->lte('created', $this->to));
    }
}