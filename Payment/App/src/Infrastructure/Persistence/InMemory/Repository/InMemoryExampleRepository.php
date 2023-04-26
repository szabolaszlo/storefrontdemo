<?php

namespace App\Infrastructure\Persistence\InMemory\Repository;

use App\Domain\Example;
use App\Domain\ExampleRepositoryInterface;

class InMemoryExampleRepository implements ExampleRepositoryInterface
{
    public function getExample(): Example
    {
        $example = new Example();
        $example->setContent('asd');

        return $example;
    }
}