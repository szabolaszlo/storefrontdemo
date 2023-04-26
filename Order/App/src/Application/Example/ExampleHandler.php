<?php

namespace App\Application\Example;


use App\Application\Example\Dto\ExampleOutput;
use App\Domain\ExampleRepositoryInterface;

class ExampleHandler
{
    public function __construct(
        private  ExampleRepositoryInterface $exampleRepository
    )
    {
    }

    public function __invoke(ExampleQuery $query): ExampleOutput
    {
        $example = $this->exampleRepository->getExample();

        $output = new ExampleOutput();
        $output->setContent($example->getContent());

        return $output;
    }
}