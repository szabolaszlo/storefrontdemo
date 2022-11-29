<?php
namespace App\WebshopBundle\Presentation\Api\Rest;

use App\WebshopBundle\Application\RegisterCustomer\RegisterCustomerCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
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

        if (!$request->isMethod('POST')){
            return new JsonResponse();
        }

        $data = json_decode($request->getContent());

        $customer  =  $this->handle(
                new RegisterCustomerCommand(
                    $data->firstname,
                    $data->lastname,
                    $data->email,
                    $data->password,
                    isset($data->newsletter)
                )
            );

        return new JsonResponse(
            array(
                "id"=>$customer->getId(),
                "first"=>$customer->getFirstname(),
                "lastname"=>$customer->getLastName(),
                "password"=>$customer->getPassword(),
                "newsletter"=>$customer->hasNewsletterSubscription(),
            )
        );
    }
}