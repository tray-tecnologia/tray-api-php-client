<?php

namespace Tests\Feature\Services;

use Tests\TestCase;
use Tray\Client;
use Tray\Entities\Catalog\Product;
use Tray\Pagination\Contracts\IPaginator;
use Tray\Services\StoreService;
use Tray\Support\Contracts\ICollection;

class CatalogServiceTest extends TestCase
{
    /**
     * @var StoreService $store
     */
    protected $store;

    /**
     * @inheritDoc
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

        $client      = new Client($config);
        $this->store = new StoreService($client);
    }

    /**
     * @return void
     */
    public function testShouldGetPaginatedProducts(): void
    {
        // Act
        $items = $this->store->brand->paginate();

        echo '<pre>';
        print_r($items);
        echo '</pre>';
        exit;

        // Assert
        static::assertInstanceOf(IPaginator::class, $products);
        static::assertInstanceOf(ICollection::class, $products->getItems());
        static::assertContainsOnlyInstancesOf(Product::class, $products->getItems()->all());
    }
}
