<?php

namespace App\WebshopBundle\Presentation\Web\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OauthLoginController extends AbstractController
{
    public function connect(ClientRegistry $registry): Response
    {
        return $registry->getClient('oauth_server_oauth')->redirect(['customer_own_data']);
    }

    public function connectCheck(Request $request, ClientRegistry $registry)
    {
        $client = $registry->getClient('oauth_server_oauth');
        try {
            $accessToken = $client->getAccessToken();
        } catch (IdentityProviderException $e) {

        }

        $request->getSession()->set('access_token', $accessToken);

        return $this->redirectToRoute('app_account');
    }
}