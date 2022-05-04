<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use Tray\Client;
use Tray\Services\StoreService;

class StoreServiceTest extends TestCase
{
    /**
     * @var StoreService $store
     */
    protected $store;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = new Client\Config([
            'api_url'            => getenv('API_URI'),
            'consumer_key'       => getenv('CONSUMER_KEY'),
            'consumer_secret'    => getenv('CONSUMER_SECRET'),
            'authorization_code' => getenv('AUTHORIZATION_CODE'),
        ]);
        $client       = new Client($config);
        $this->store  = new StoreService($client);
    }

    /**
     * @return void
     */
    public function testShouldProvideTheResources(): void
    {
        // Act
        $resource = $this->store->store->find();

        die($resource);
    }
}
