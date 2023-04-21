<?php

namespace App\Infrastructure\Persistence\Doctrine\Specification;

use App\Domain\Specification\CriteriaInterface;
use Doctrine\Common\Collections\Criteria;

class DoctrineCriteria extends Criteria implements CriteriaInterface
{
    public static function create(): DoctrineCriteria
    {
        return new static();
    }
}
