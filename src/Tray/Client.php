<?php

namespace Tray;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Tray\Client\Contracts\Auth\IAuthenticator;
use Tray\Client\Contracts\Http\IRequest;
use Tray\Client\Contracts\IClient;
use Tray\Client\Contracts\IConfig;
use Tray\Client\Auth\Guards\SessionGuard;
use Tray\Client\Auth\Authenticator;

/**
 * @TODO Criar injeção de dependência.
*/
class Client implements IClient
{
    /**
     * The client's config storage.
     *
     * @var IConfig $config
     */
    protected $config;

    /**
     * The auth strategy used.
     *
     * @var IAuthenticator $authenticator
     */
    protected $authenticator;

    /**
     * The request's instance
     *
     * @var IRequest|null $request
     */
    protected $request;

    /**
     * @inheritDoc
     */
    public function __construct(IConfig $config, ?IAuthenticator $authenticator = null)
    {
        $this->config        = $config;
        $this->authenticator = $authenticator ?? $this->createDefaultAuthenticator();
    }

    /**
     * @inheritDoc
     */
    public function getConfig(): IConfig
    {
        return $this->config;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequest(): IRequest
    {
        if (!$this->request) {
            $this->request = new Client\Http\Request($this->createHttpClient());
        }

        return $this->request;
    }

    /**
     * Makes the default auth handler.
     *
     * @return IAuthenticator
     */
    protected function createDefaultAuthenticator(): IAuthenticator
    {
        return new Authenticator(new SessionGuard(), $this->config);
    }

    /**
     * Makes a fresh http instance.
     *
     * @return ClientInterface
     */
    protected function createHttpClient(): ClientInterface
    {
        $stack = new HandlerStack();

        $stack->setHandler(new CurlHandler());
        $stack->push($this->authenticator);

        $options = [
            'base_uri'   => $this->getConfig()->getApiUrl(),
            'exceptions' => true,
            'handler'    => $stack,
            'timeout'    => 60
        ];

        return new HttpClient($options);
    }
}
