<?php

namespace App\Application\Example;

class ExampleQuery
{

    public function __construct(
        private string $example
    )
    {
    }

    public function getExample(): string
    {
        return $this->example;
    }
}