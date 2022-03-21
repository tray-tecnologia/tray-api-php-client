<?php

namespace Tray;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use RuntimeException;
use Tray\Client\Contracts\Auth\IAuthenticator;
use Tray\Client\Contracts\Auth\IGuard;
use Tray\Client\Contracts\Http\IRequest;
use Tray\Client\Contracts\IClient;
use Tray\Client\Contracts\IConfig;
use Tray\Client\Auth\Guards\SessionGuard;
use Tray\Client\Auth\Authenticator;
use Tray\Entities\Entity;

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
     * @var Authenticator $authenticator
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
    public function __construct(IConfig $config, ?IGuard $guard = null)
    {
        $this->config        = $config;
        $this->authenticator = $this->createAuthenticator($guard);
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
     * @param IGuard|null $guard
     * @return Authenticator
     */
    protected function createAuthenticator(?IGuard $guard): Authenticator
    {
        if (!$guard) {
            $guard = new SessionGuard();
        }

        $authenticator = $this->getAuthenticatorClass();
        return new $authenticator($guard, $this->config);
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

    /**
     * Get the authenticator instance
     *
     * @return class-string<IAuthenticator>
     */
    protected function getAuthenticatorClass(): string
    {
        $authenticator = null;
        if ($this->config instanceof Entity) {
            $authenticator = $this->config->getAttribute('authenticator');
            if ($authenticator && !is_a($authenticator, IAuthenticator::class, true)) {
                throw new RuntimeException("The authenticator instance must implements the ".IAuthenticator::class);
            }
        }

        return $authenticator ?? Authenticator::class;
    }
}
