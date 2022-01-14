<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tray\Client;
use Tray\Client\Config;

class ClientTest extends TestCase
{
    public function testOne(): void
    {
        $config = new Config([
            'api_url'            => 'https://725109.commercesuite.com.br/web_api',
            'consumer_key'       => '114a193be3dbabc10dcc1c7edbced36a7f2a13adab413a186ddf0fed053dfb7c',
            'consumer_secret'    => '7822c1ebe1ab8d7c51dd121217c00caa2d52eb335b3f245d210d72269d266f91',
            'authorization_code' => '0eadb3a759953ce72aaadf66bee84fa9e8eb9decec8736c11396ecf57ef1e4a9',
        ]);

        $client    = new Client($config);
        $response  = $client->getRequest()->get('/products', ['page' => 2, 'limit' => 3]);

        $formatter = new TestResponseFormatter($response);
        echo '<pre>';
        print_r($formatter->toPaginator()->getPageSize());
        echo '</pre>';
        exit;
    }
}
