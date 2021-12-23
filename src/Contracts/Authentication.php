<?php

namespace ApiCommerceClient\Authentication\Contracts;

interface Authentication {
    /**
     * Retorna a loja autenticada.
     *
     * @return Store
     */
    public function store(): Store;
}
