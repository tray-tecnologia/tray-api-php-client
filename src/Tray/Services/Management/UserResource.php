<?php

namespace Tray\Services\Management;

use Tray\Entities\Management\User;
use Tray\Services\Concerns;
use Tray\Services\Contracts\IResource;

/**
 * @method User find($id)
 */
class UserResource extends IResource
{
    use Concerns\Findable;

    /**
     * @inheritDoc
     */
    protected function getApiUri(): string
    {
        return '/users';
    }

    /**
     * @inheritDoc
     */
    protected function getEntityClass(): string
    {
        return User::class;
    }
}
