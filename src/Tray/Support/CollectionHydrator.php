<?php

namespace Tray\Support;

use Tray\Support\Contracts\{ICollection, IHydrator};

class CollectionHydrator implements IHydrator
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
     * @param ICollection $collection
     */
    public function hydrate(array $content, $collection): void
    {
        if (isset($content[$this->envelope])) {
            $content = $content[$this->envelope];
        }

        $collection->push(...$content);
    }
}
