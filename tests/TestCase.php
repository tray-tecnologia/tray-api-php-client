<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

use ReflectionClass;
use RuntimeException;

abstract class TestCase extends BaseTestCase
{
    /**
     * Returns the contents of the given json mock
     *
     * @param string $name
     * @return string
     */
    public function getJsonMock(string $name): string
    {
        $reflection = new ReflectionClass(static::class);
        $directory  = dirname($reflection->getFileName());
        $fileName   = "$directory/__mocks__/$name.json";

        if (!file_exists($fileName)) {
            throw new RuntimeException("File '$fileName' not found");
        }

        return file_get_contents($fileName);
    }

    /**
     * Returns the contents of the given mock
     *
     * @param string $name
     * @param string $type
     * @return array
     */
    public function getMock(string $name, $type = 'json'): array
    {
        if ($type === 'json') {
            return json_decode($this->getJsonMock($name), true);
        }

        return [];
    }
}
