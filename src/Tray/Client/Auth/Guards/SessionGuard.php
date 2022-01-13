<?php

namespace Tray\Client\Auth\Guards;

use Tray\Client\Contracts\Auth\{IGuard, Token};

class SessionGuard implements IGuard
{
    /**
     * @var ?Token $token
    */
    protected $token;

    /**
     * SessionGuard constructor.
     */
    public function __construct()
    {
        $this->startSession();
        $this->update();
    }

    /**
     * @inheritDoc
     */
    public function setToken(Token $token): void
    {
        $_SESSION['access-token'] = $token->toArray();
        $this->update();
    }

    /**
     * @inheritDoc
     */
    public function getToken(): ?Token
    {
        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function clear(): void
    {
        unset($_SESSION['access-token']);
        $this->update();
    }

    /**
     * Updates the local token.
     *
     * @return void
     */
    protected function update(): void
    {
        $payload = $_SESSION['access-token'] ?? null;
        if (!$payload) {
            $this->token = null;
            return;
        }

        $this->token = new Token($payload);
    }

    /**
     * Determines whether the session is active or not.
     *
     * @return void
     */
    protected function startSession(): void
    {
        if ($this->isSessionStarted()) {
            return;
        }

        session_start();
    }

    /**
     * Determines whether the session is active or not.
     *
     * @return bool
     */
    protected function isSessionStarted(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}
