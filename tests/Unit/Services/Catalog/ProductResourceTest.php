<?php

namespace Tests\Unit\Services\Catalog;

use GuzzleHttp\Psr7\Response;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;
use Tray\Client\Contracts\IClient;
use Tray\Client\Http\JsonResponse;
use Tray\Entities\Catalog\Product;
use Tray\Services\Catalog;
use Tray\Services\CatalogService;
use Tray\Support\Contracts\ICollection;

class ProductResourceTest extends TestCase
{
    /**
     * @var MockInterface&IClient $clientMock
     */
    protected $clientMock;

    /**
     * @var MockInterface&CatalogService $catalog
     */
    protected $catalogMock;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->clientMock  = Mockery::mock(IClient::class);
        $this->catalogMock = Mockery::mock(CatalogService::class, [$this->clientMock])->makePartial();
    }

    /**
     * @return void
     */
    public function testShouldRetrieveTheProducts(): void
    {
        // Arrange
        $resource = new Catalog\ProductResource($this->catalogMock);
        $contents = $this->getJsonMock('products');
        $response = new JsonResponse(new Response(200, [], $contents));

        $this->clientMock
            ->shouldReceive('getRequest->get')
            ->once()
            ->withArgs(['/products', []])
            ->andReturn($response);

        // Act
        $products = $resource->paginate();

        // Assert
        static::assertEquals(11, $products->getTotal());
        static::assertEquals(1, $products->getPageNumber());
        static::assertEquals(30, $products->getPageSize());
        static::assertInstanceOf(ICollection::class, $products->getItems());
        static::assertContainsOnlyInstancesOf(Product::class, $products->getItems()->all());
    }

    /**
     * @return void
     */
    public function testShouldFindTheProductWithTheGivenId(): void
    {
        // Arrange
        $contents = $this->getJsonMock('product');
        $resource = new Catalog\ProductResource($this->catalogMock);
        $response = new JsonResponse(new Response(200, [], $contents));

        $this->clientMock
            ->shouldReceive('getRequest->get')
            ->once()
            ->withArgs(['/products/1'])
            ->andReturn($response);

        // Act
        $product = $resource->find(1);

        // Assert
        static::assertInstanceOf(Product::class, $product);
        static::assertEquals(1, $product->getKey());
        static::assertEquals(63, $product->brand_id);
        static::assertEquals(3, $product->category_id);
        static::assertEquals('A song of ice and fire: Game of Thrones', $product->name);
    }

    /**
     * @return void
     */
    public function testShouldCreateTheProduct(): void
    {
        // Arrange
        $product  = $this->getMock('product');
        $message  = [
            'message' => 'created',
            'id'      => '1',
            'code'    => '201',
        ];
        $resource = new Catalog\ProductResource($this->catalogMock);
        $response = new JsonResponse(new Response(201, [], json_encode($message)));

        $this->clientMock
            ->shouldReceive('getRequest->post')
            ->once()
            ->withArgs(['/products', [], ['Product' => $product]])
            ->andReturn($response);

        // Act
        $productId = $resource->store($product);

        // Assert
        static::assertEquals(1, $productId);
    }

    /**
     * @return void
     */
    public function testShouldUpdateTheProduct(): void
    {
        // Arrange
        $changes = [
            'stock' => 100
        ];
        $message  = [
            'message' => 'Saved',
            'id'      => '1',
            'code'    => '200',
        ];
        $resource = new Catalog\ProductResource($this->catalogMock);
        $response = new JsonResponse(new Response(200, [], json_encode($message)));

        $this->clientMock
            ->shouldReceive('getRequest->put')
            ->once()
            ->withArgs(['/products/1', [], ['Product' => $changes]])
            ->andReturn($response);

        // Act
        $updated = $resource->update(1, $changes);

        // Assert
        static::assertTrue($updated);
    }

    /**
     * @return void
     */
    public function testShouldDeleteTheProduct(): void
    {
        // Arrange
        $message  = [
            'message' => 'Deleted',
            'id'      => '1',
            'code'    => '200',
        ];
        $resource = new Catalog\ProductResource($this->catalogMock);
        $response = new JsonResponse(new Response(200, [], json_encode($message)));

        $this->clientMock
            ->shouldReceive('getRequest->delete')
            ->once()
            ->withArgs(['/products/1'])
            ->andReturn($response);

        // Act
        $deleted = $resource->delete(1);

        // Assert
        static::assertTrue($deleted);
    }
}
