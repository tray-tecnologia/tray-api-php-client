<?php

namespace Tray\Client\Contracts\Auth;

interface IGuard
{
    /**
     * Stores the token given.
     *
     * @param Token $token
     */
    public function setToken(Token $token): void;

    /**
     * Retrieves the token.
     *
     * @return Token|null
     */
    public function getToken(): ?Token;

    /**
     * Clear the token record.
     *
     * @return void
     */
    public function clear(): void;
}
