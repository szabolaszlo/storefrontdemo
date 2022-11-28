<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use App\WebshopBundle\Application\RegisterCustomer\RegisterCustomerCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class RegistrationController extends AbstractController
{

    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function registration(Request $request): Response
    {
        if ($request->isMethod('POST')){
            $customer = $this->handle(
                new RegisterCustomerCommand(
                    $request->get('firstname'),
                    $request->get('lastname'),
                    $request->get('email'),
                    $request->get('password')
                )
            );
            return $this->render('@webshop/registration_complete.html.twig', array("customer"=>$customer));
        }

        return $this->render('@webshop/registration.html.twig', array());
    }
}