<?php

namespace Tray\Client;

class Config implements Contracts\IConfig
{
    /**
     * The store's api url.
     *
     * @var string $apiUrl
     */
    protected $apiUrl = '';

    /**
     * The application's consumer key.
     *
     * @var string $consumerKey
     */
    protected $consumerKey = '';

    /**
     * The application's secret key.
     *
     * @var string $consumerSecret
     */
    protected $consumerSecret = '';

    /**
     * The app's authorization code.
     *
     * @var string $authorizationCode
     */
    protected $authorizationCode = '';

    /**
     * @inheritDoc
     */
    public function __construct(array $config)
    {
        $this->setApiUrl($config['api_url'] ?? '');
        $this->setConsumerKey($config['consumer_key'] ?? '');
        $this->setConsumerSecret($config['consumer_secret'] ?? '');
        $this->setAuthorizationCode($config['authorization_code'] ?? '');
    }

    /**
     * @inheritDoc
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    protected function setApiUrl(string $apiUrl): void
    {
        if ($apiUrl && !preg_match('/\/$/', $apiUrl)) {
            $apiUrl .= '/';
        }

        $this->apiUrl = $apiUrl;
    }

    /**
     * @inheritDoc
     */
    public function getConsumerKey(): string
    {
        return $this->consumerKey;
    }

    /**
     * @param string $consumerKey
     */
    protected function setConsumerKey(string $consumerKey): void
    {
        $this->consumerKey = $consumerKey;
    }

    /**
     * {@inheritDoc}
     */
    public function getConsumerSecret(): string
    {
        return $this->consumerSecret;
    }

    /**
     * @param string $consumerSecret
     */
    protected function setConsumerSecret(string $consumerSecret): void
    {
        $this->consumerSecret = $consumerSecret;
    }

    /**
     * @inheritDoc
     */
    public function getAuthorizationCode(): string
    {
        return $this->authorizationCode;
    }

    /**
     * @param string $authorizationCode
     */
    protected function setAuthorizationCode(string $authorizationCode): void
    {
        $this->authorizationCode = $authorizationCode;
    }
}
