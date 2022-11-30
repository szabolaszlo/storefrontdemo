<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use App\WebshopBundle\Application\CreateCustomer\CreateCustomerCommand;
use App\WebshopBundle\Application\QueryCustomer\QueryCustomerCommand;
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

            $newsletterId = null;

            if($request->get('newsletter',false)){
                $subscriber = $this->handle(
                    new SubscribeToNewsletterCommand(
                        $request->get('firstname'),
                        $request->get('lastname'),
                        $request->get('email'),
                        true
                    )
                );
                $newsletterId = $subscriber->getId();
            }

            $customer = $this->handle(
                new CreateCustomerCommand(
                    $request->get('firstname'),
                    $request->get('lastname'),
                    $request->get('email'),
                    $request->get('password'),
                    $newsletterId
                )
            );

            return $this->redirectToRoute('app_account',array('id'=>$customer->getId()));

        }

        return $this->render('@webshop/registration.html.twig', array());
    }

    public function account(Request $request): Response
    {

        $query = new QueryCustomerCommand($request->get('id'));
        $customer = $this->handle($query);

        return $this->render('@webshop/account.html.twig', array("customer"=>$customer));
    }
}