<?php

namespace Tray\Entities\Contracts;

use ArrayAccess;
use JsonSerializable;
use Tray\Support\Contracts\IArrayable;

interface IEntity extends ArrayAccess, JsonSerializable, IArrayable
{
    /**
     * Cria uma nova instância de entidade.
     *
     * @param  array $attributes
     * @return void
     */
    public function __construct(array $attributes = []);

    /**
     * Get a subset of the model's attributes.
     *
     * @param  array|mixed $attributes
     * @return array
     */
    public function only($attributes): array;

    /**
     * Retorna o nome da chave de identificação da entidade.
     *
     * @return string
     */
    public function getKeyName();

    /**
     * Retorna o valor da chave de identificação da entidade.
     *
     * @return mixed
     */
    public function getKey();

    /**
     * Define o valor da chave de identificação da entidade.
     *
     * @param  mixed $value
     * @return static
     */
    public function setKey($value);

    /**
     * Get an attribute from the model.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key);

    /**
     * Set a given attribute on the model.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value);

    /**
     * Preenche a modal com os atributos fornecidos.
     *
     * @param  array $attributes
     * @return static
     */
    public function fill(array $attributes);

    /**
     * Get all of the current attributes on the entity.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Set the array of entity attributes. No checking is done.
     *
     * @param  array $attributes
     * @return static
     */
    public function setRawAttributes(array $attributes);
}
