<?php

namespace Tray\Client\Contracts\Auth;

use Carbon\Carbon;
use Exception;
use Tray\Support\Contracts\IArrayable;

class Token implements IArrayable
{
    /**
     * @var string|null
     */
    protected $accessToken = null;

    /**
     * @var string|null
     */
    protected $refreshToken = null;

    /**
     * @var string|null
     */
    protected $accessTokenExpirationDate = null;

    /**
     * @var string|null
     */
    protected $refreshTokenExpirationDate = null;

    /**
     * @var int|null
     */
    protected $storeId = null;

    /**
     * Token constructor.
     *
     * @param array $payload
     */
    public function __construct(array $payload)
    {
        $this->fill($payload);
    }

    /**
     * Fill's the token with the payload given.
     *
     * @param array $payload
     */
    public function fill(array $payload): void
    {
        $this->accessToken                = $payload['access_token'] ?? null;
        $this->refreshToken               = $payload['refresh_token'] ?? null;
        $this->accessTokenExpirationDate  = $payload['date_expiration_access_token'] ?? null;
        $this->refreshTokenExpirationDate = $payload['date_expiration_refresh_token'] ?? null;
        $this->storeId                    = $payload['store_id'] ?? null;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return [
            'access_token'                  => $this->accessToken,
            'refresh_token'                 => $this->refreshToken,
            'date_expiration_access_token'  => $this->accessTokenExpirationDate,
            'date_expiration_refresh_token' => $this->refreshTokenExpirationDate,
            'store_id'                      => $this->storeId,
        ];
    }

    /**
     * Determines whether the access token has expired or not.
     *
     * @return bool
     */
    public function hasAccessTokenExpired(): bool
    {
        return $this->hasExpired($this->accessTokenExpirationDate);
    }

    /**
     * Determines whether the refresh token has expired or not.
     *
     * @return bool
     */
    public function hasRefreshTokenExpired(): bool
    {
        return $this->hasExpired($this->refreshTokenExpirationDate);
    }

    /**
     * @return int|null
     */
    public function getStoreId(): ?int
    {
        return $this->storeId;
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * Determines whether the given date has expired.
     *
     * @param string|null $date
     *
     * @return bool
     */
    protected function hasExpired(?string $date): bool
    {
        if (!$date) {
            return true;
        }

        try {
            $now       = new Carbon('now');
            $expiresAt = new Carbon($date);

            // Let's add five minutes to make sure the token does not expire during the request.
            $now->addMinutes(5);

            return $expiresAt->gt($now);
        } catch (Exception $e) {
        }

        return true;
    }
}
