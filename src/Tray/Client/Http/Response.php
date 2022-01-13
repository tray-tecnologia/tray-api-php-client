<?php

namespace Tray\Client\Http;

use Psr\Http\Message\ResponseInterface;
use Tray\Client\Contracts\Http\IResponse;
//use Tray\Entities\Contracts\IEntity;
use Tray\Entities\Entity;
//use Tray\Pagination\Contracts\IPaginator;
use Tray\Pagination\Paginator;
use Tray\Support\Collection;
//use Tray\Support\Contracts\ICollection;

class Response implements IResponse
{
    /**
     * @var array $options
     */
    protected $options = [
        'entity-class'     => Entity::class,
        'collection-class' => Collection::class,
        'paginator-class'  => Paginator::class,
    ];

    /**
     * The http response received.
     *
     * @var ResponseInterface $httpResponse
     */
    protected $httpResponse;

    /**
     * @inheritDoc
     */
    public function __construct(ResponseInterface $response, array $options = [])
    {
        $this->httpResponse = $response;
        $this->options      = array_merge($this->options, $options);
    }

    /**
     * @inheritDoc
     */
    public function getContents()
    {
        $contents = $this->httpResponse->getBody()->getContents();
        return json_decode($contents, true);
    }

//    /**
//     * @inheritDoc
//     */
//    public function withPaginator(string $paginatorClass): IResponse
//    {
//        return new static($this->httpResponse, ['paginator-class' => $paginatorClass]);
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function withCollection(string $collectionClass): IResponse
//    {
//        return new static($this->httpResponse, ['collection-class' => $collectionClass]);
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function withEntity(string $entityClass): IResponse
//    {
//        return new static($this->httpResponse, ['entity-class' => $entityClass]);
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function toPaginator(): IPaginator
//    {
//        $collection = $this->toCollection();
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function toCollection(): ICollection
//    {
//        // TODO: Implement toCollection() method.
//    }
//
//    /**
//     * @inheritDoc
//     */
//    public function toEntity(): IEntity
//    {
//        $contents = $this->getContents();
//        return $this->makeEntity($contents);
//    }
//
//    /**
//     * Make a new entity with the given atributes.
//     *
//     * @param array $attributes
//     * @return IEntity
//     */
//    private function makeEntity(array $attributes): IEntity
//    {
//        /** @var class-string<IEntity> $entityClass */
//        $entityClass = $this->options['entity-class'];
//        return new $entityClass($attributes);
//    }
}
