<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use App\WebshopBundle\Application\Account\QueryCustomerAccountCommand;

use App\WebshopBundle\Application\Registration\RegistrationCommand;
use App\WebshopBundle\Application\SubscribeToNewsletter\SubscribeToNewsletterCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class CustomerController extends AbstractController
{

    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function signUp(Request $request): Response
    {
        if ($request->isMethod('POST')){


            $customer = $this->handle(
                new RegistrationCommand(
                    $request->get('firstname'),
                    $request->get('lastname'),
                    $request->get('email'),
                    $request->get('password'),
                    $request->get('newsletter',false)
                )
            );

            return $this->redirectToRoute('app_account',array('id'=>$customer->getCustomerId()));

        }

        return $this->render('@webshop/registration.html.twig', []);
    }

    public function account(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        $query = new QueryCustomerAccountCommand($this->getUser()->getId());
        $customer = $this->handle($query);

        return $this->render('@webshop/account.html.twig', ["customer"=>$customer]);
    }
}