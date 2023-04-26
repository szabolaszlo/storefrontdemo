<?php

namespace App\Presentation\Api\Controller;

use App\Application\Example\ExampleQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class ExampleController extends AbstractController
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function index()
    {
        return $this->json([
            $this->handle(
                new ExampleQuery('Hello World')
            )
        ]);
    }
}