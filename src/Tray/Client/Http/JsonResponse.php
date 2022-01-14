<?php

namespace Tray\Client\Http;

use Psr\Http\Message\ResponseInterface;
use Tray\Client\Contracts\Http\IResponse;

class JsonResponse implements IResponse
{
    /**
     * The http response received.
     *
     * @var ResponseInterface $httpResponse
     */
    protected $httpResponse;

    /**
     * The content of the response.
     *
     * @var array $contents
     */
    protected $contents;

    /**
     * @inheritDoc
     */
    public function __construct(ResponseInterface $response)
    {
        $this->httpResponse = $response;
    }

    /**
     * @inheritDoc
     */
    public function getContents(): array
    {
        if (!$this->contents) {
            $contents = $this->httpResponse->getBody()->getContents();
            $this->contents = json_decode($contents, true);
        }

        return $this->contents;
    }
}
