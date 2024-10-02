<?php

namespace TaskuTark\TTPayment;

use GuzzeleHttp\Client;

class TTPaymentGateway
{

    protected $client;
    protected string $username;
    protected string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->client = new Client();
    }

    public function makeOneOffPayment(array $paymentDetails): string
    {
        $response = $this->client->request('POST', $this->apiIrl, [
            'headers' => [
                'Authentication' => 'Basic ',
                'Content-Type' => 'application/json'
            ],
            'json' => $paymentDetails
        ]);

        return $response->getBody()->getContents();
    }
}
