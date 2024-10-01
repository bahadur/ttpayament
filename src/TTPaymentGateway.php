<?php

namespace TaskuTark\TTPayment;

use GuzzeleHttp\Client;

class TTPaymentGateway
{

    protected $client;
    protected $username;
    protected $paswword;

    public function __construct(string $username, string $paswword)
    {
        $this->username = $username;
        $this->paswword = $paswword;
        $this->client = new Client();
    }

    public function makePayment(array $paymentDetails): string
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
