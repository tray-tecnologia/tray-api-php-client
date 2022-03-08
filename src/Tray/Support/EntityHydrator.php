<?php

namespace Tray\Support;

use Tray\Support\Contracts\IHydrator;
use Tray\Entities\Entity;

class EntityHydrator implements IHydrator
{
    /**
     * The envelope name that encapsulates the data.
     *
     * @var string $envelope
     */
    protected $envelope;

    /**
     * CollectionHydrator constructor.
     *
     * @param string $envelope
     */
    public function __construct(string $envelope)
    {
        $this->envelope = $envelope;
    }

    /**
     * @inheritDoc
     * @param Entity $entity
     */
    public function hydrate(array $content, $entity): void
    {
        if ($this->envelope && isset($content[$this->envelope])) {
            $content = $content[$this->envelope];
        }

        $entity->fill($content);
    }
}
