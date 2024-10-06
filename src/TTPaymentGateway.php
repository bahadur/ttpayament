<?php

namespace TaskuTark\TTPayment;

use GuzzleHttp\Client;

class TTPaymentGateway
{
    protected $apiUrl;
    protected $client;
    protected $username;
    protected $password;

    public function __construct(string $username, string $password)
    {
        $this->apiUrl = "https://igw-seb-demo.every-pay.com/api/";
        $this->username = $username;
        $this->password = $password;
        $this->client = new Client();
    }

    public function makeOneOffPayment(array $paymentDetails): string
    {
        $param = [
            "timestamp" => \Carbon\Carbon::now()->format('c'),
            "request_token" => true,
            "token_agreement" => "unscheduled",
            "customer_ip" => $_SERVER['REMOTE_HOST'],
            "api_username" => $this->username,

        ];
        $params = array_merge($paymentDetails, $param);

        $response = $this->client->request('POST', $this->apiUrl . 'v4/payments/oneoff', [
            'headers' => [
                'Authentication' => 'Basic ' . base64_encode("$this->username:$this->password"),
                'Content-Type' => 'application/json'
            ],
            'json' => $params
        ]);

        return $response->getBody()->getContents();
    }
}
