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
        ]);

        $client    = new Client($config);
        $response  = $client->getRequest()->get('/customers', ['page' => 2, 'limit' => 3]);

        echo '<pre>';
        print_r($response->getContents()['paging']);
        echo '</pre>';
        exit;
        $formatter = new TestResponseFormatter($response);
        echo '<pre>';
        print_r($formatter->toPaginator()->getItems()->get(0)->toArray());
        echo '</pre>';
        exit;
    }
}
