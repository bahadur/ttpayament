<?php

namespace TaskuTark\TTPayment;

use GuzzeleHttp\Client;

class TTPaymentGateway
{

    protected $apiUrl;
    protected $client;
    protected string $username;
    protected string $password;

    public function __construct(string $username, string $password)
    {
        $this->apiUrl = "https://igw-seb-demo.every-pay.com/api/";
        $this->username = $username;
        $this->password = $password;
        $this->client = new Client();
    }

    public function makeOneOffPayment(array $paymentDetails): string
    {
        $response = $this->client->request('POST', $this->apiUrl . 'v4/payments/oneoff', [
            'headers' => [
                'Authentication' => 'Basic ' . base64_encode("$this->username:$this->password"),
                'Content-Type' => 'application/json'
            ],
            'json' => $paymentDetails
        ]);

        return $response->getBody()->getContents();
    }
}
