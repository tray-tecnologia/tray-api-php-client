<?php

namespace Tray\Client\Auth;

use Tray\Client\Auth\Authenticator as BaseAuthenticator;
use Tray\Client\Contracts\Auth\Token;
use Tray\Client\Exception\UnauthorizedException;

class SuperTokenAuthenticator extends BaseAuthenticator
{
    protected function requestAccessToken(): Token
    {
        return $this->getSuperToken();
    }

    protected function renewToken(string $refreshToken): Token
    {
        return $this->getSuperToken($refreshToken);
    }

    protected function getSuperToken(?string $refreshToken = ''): Token
    {
        $id = $this->config->getAttribute('app_id') ?? '';
        $salt = $this->config->getAttribute('app_salt') ?? '';
        $cipher = $this->config->getAttribute('app_cipher_algorithm') ?? '';
        $storeId = $this->config->getAttribute('store_id') ?? '';

        if (empty($id) || empty($salt) || empty($cipher) || empty($storeId)) {
            throw new UnauthorizedException();
        }

        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);

        $createdAt = new \DateTime('now');
        $content = $id . '/-_' . $createdAt->format('Y-m-d H:i:s');

        $encryptedText = openssl_encrypt($content, $cipher, $salt, 0, $iv);
        $encrypted = base64_encode($iv . '-|-' . $encryptedText);

        $accessToken = base64_encode(
            base64_encode($storeId) . '/-_' .
            md5($salt . $storeId) . '/-_' .
            $encrypted
        );

        $payload = [
            'access_token' => $accessToken,
            'store_id' => (int)$storeId,
            'refresh_token' => $refreshToken
        ];

        return new Token($payload);
    }
}
