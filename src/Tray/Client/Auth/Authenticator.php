<?php

namespace Tray\Client\Auth;

use Tray\Client\Contracts\{Auth\IGuard, Auth\IAuthenticator, Auth\Token, IConfig};
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Message\RequestInterface;
use Throwable;
use Tray\Client\Exception\Http\UnauthorizedException;

/**
 * @SuppressWarnings(PHPMD.StaticAccess)
 */
class Authenticator implements IAuthenticator
{
    /**
     * @var IGuard $guard
     */
    protected $guard;

    /**
     * @var IConfig $config
     */
    protected $config;

    /**
     * @inheritDoc
     */
    public function __construct(IGuard $guard, IConfig $config)
    {
        $this->guard  = $guard;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     * @throws     UnauthorizedException
     * @throws     GuzzleException
     */
    public function __invoke(callable $handler): callable
    {
        $this->authorize();

        return function (RequestInterface $request, array $options) use ($handler) {
            $token = $this->guard->getToken();
            $query = ['access_token' => $token->getAccessToken()];

            /** @var string $url */
            $url     = preg_replace('/\?$/', '', $request->getUri());
            $queries = http_build_query($query);
            $url     = $url . (strpos($url, '?') !== false ? '&' : '?') . $queries;

            $request = $request->withUri(new Uri($url));

            return $handler($request, $options);
        };
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws UnauthorizedException
     */
    protected function authorize(): void
    {
        $token = $this->guard->getToken();

        if (!$token || $token->hasRefreshTokenExpired()) {
            $this->guard->setToken($this->requestAccessToken());
            return;
        }

        if ($token->hasAccessTokenExpired()) {
            $this->guard->setToken($this->renewToken($token->getRefreshToken()));
        }
    }

    /**
     * Requests an access token.
     *
     * @return Token
     * @throws GuzzleException
     * @throws UnauthorizedException
     */
    protected function requestAccessToken(): Token
    {
        $client = new Client(
            [
            'base_uri' => $this->config->getApiUrl(),
            ]
        );

        $response = $client->post(
            'auth', [
            'allow_redirects' => true,
            'form_params'     => [
                'consumer_key'    => $this->config->getConsumerKey(),
                'consumer_secret' => $this->config->getConsumerSecret(),
                'code'            => $this->config->getAuthorizationCode(),
            ]
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new UnauthorizedException();
        }

        $payload = json_decode($response->getBody(), true);
        return new Token($payload);
    }

    /**
     * Refreshes the access token.
     *
     * @param  string $refreshToken
     * @return Token
     * @throws GuzzleException
     * @throws UnauthorizedException
     */
    protected function renewToken(string $refreshToken): Token
    {
        $client = new Client(
            [
            'base_uri' => $this->config->getApiUrl(),
            ]
        );

        $response = $client->get(
            'auth', [
            'allow_redirects' => true,
            'query'           => ['refresh_token' => $refreshToken]
            ]
        );

        if ($response->getStatusCode() !== 200) {
            throw new UnauthorizedException();
        }

        $payload = json_decode($response->getBody(), true);
        return new Token($payload);
    }
}
