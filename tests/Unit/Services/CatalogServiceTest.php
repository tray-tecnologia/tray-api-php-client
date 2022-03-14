<?php

namespace Tests\Unit\Services;

use Mockery;
use Tests\TestCase;
use Tray\Client\Contracts\IClient;
use Tray\Services\Catalog;
use Tray\Services\CatalogService;

class CatalogServiceTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface&IClient $clientMock
     */
    protected $clientMock;

    /**
     * @var CatalogService $catalog
     */
    protected $catalog;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->clientMock = Mockery::mock(IClient::class);
        $this->catalog    = new CatalogService($this->clientMock);
    }

    /**
     * @dataProvider resources
     * @return void
     */
    public function testShouldProvideTheResources(string $propertyName, string $expected): void
    {
        // Act
        $resource = $this->catalog->{$propertyName};

        // Assert
        static::assertInstanceOf($expected, $resource);
    }

    /**
     * Data provider for resources test.
     *
     * @return array
     */
    public function resources(): array
    {
        return [
            ['category', Catalog\CategoryResource::class],
            ['brand',    Catalog\BrandResource::class],
            ['product',  Catalog\ProductResource::class],
        ];
    }
}
