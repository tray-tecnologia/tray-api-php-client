<?php

namespace Tray\Client;

use Tray\Entities\Entity;

class Config extends Entity implements Contracts\IConfig
{
    /**
     * @inheritDoc
     */
    public function getApiUrl(): string
    {
        return $this->getAttribute('api_url') ?? '';
    }

    /**
     * @inheritDoc
     */
    public function getConsumerKey(): string
    {
        return $this->getAttribute('consumer_key') ?? '';
    }

    /**
     * {@inheritDoc}
     */
    public function getConsumerSecret(): string
    {
        return $this->getAttribute('consumer_secret') ?? '';
    }

    /**
     * @inheritDoc
     */
    public function getAuthorizationCode(): string
    {
        return $this->getAttribute('authorization_code') ?? '';
    }

    /**
     * @param string $apiUrl
     */
    protected function setApiUrlAttribute(string $apiUrl): void
    {
        if ($apiUrl && !preg_match('/\/$/', $apiUrl)) {
            $apiUrl .= '/';
        }

        $this->attributes['api_url'] = $apiUrl;
    }
}
