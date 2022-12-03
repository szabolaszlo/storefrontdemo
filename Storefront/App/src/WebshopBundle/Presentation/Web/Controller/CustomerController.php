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

    public function registration(Request $request): Response
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

        return $this->render('@webshop/registration.html.twig', array());
    }

    public function account(Request $request): Response
    {

        $query = new QueryCustomerAccountCommand($request->get('id'));
        $customer = $this->handle($query);

        return $this->render('@webshop/account.html.twig', array("customer"=>$customer));
    }
}