<?php

namespace Tray\Client\Exception\Http;

class ValidationException extends ClientException
{
    /**
     * Armazena os erros de validação.
     *
     * @var array $errors
    */
    protected $errors = [];

    /**
     * ValidationException constructor.
     *
     * @param array $errors
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($errors = [], $code = 422, \Throwable $previous = null)
    {
        parent::__construct('The given data was invalid.', $code, $previous);
        $this->errors = $errors;
    }

    /**
     * Retorna os erros de validação.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
