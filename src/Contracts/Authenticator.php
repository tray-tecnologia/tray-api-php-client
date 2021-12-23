<?php

namespace ApiCommerceClient\Authentication\Contracts;

interface Authenticator {
    /**
     * Authenticator constructor.
     */
    public function __construct();

    /**
     * Retorna a loja autenticada.
     *
     * @return Authentication
     */
    public function authenticate(): Authentication;
}
