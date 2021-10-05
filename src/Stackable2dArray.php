<?php

declare(strict_types=1);

namespace GitBalocco\CommonStructures;

use Generator;
use GitBalocco\CommonStructures\StackableArray;
use IteratorAggregate;
use Traversable;

/**
 * Class TwoDimensionalArray
 */
class Stackable2dArray implements IteratorAggregate
{
    /** @var StackableArray[] $data */
    private $data = [];

    /**
     * @param string|int $key
     * @return array
     */
    public function get($key): array
    {
        return $this->getData($key)->toArray();
    }

    /**
     * @param string|int $key
     * @return StackableArray
     */
    protected function getData($key)
    {
        if (!array_key_exists($key, $this->data)) {
            //$keyに未登録の場合、StackableArrayを格納してから返す
            $this->data[$key] = new StackableArray();
        }
        return $this->data[$key];
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $result = [];
        foreach ($this->data as $key => $item) {
            $result[$key] = $item->toArray();
        }
        return $result;
    }

    /**
     * @return Generator|Traversable
     */
    public function getIterator()
    {
        foreach ($this->data as $key => $item) {
            (yield $key => $item->toArray());
        }
    }

    /**
     * @param int|string $key
     * @param iterable $values
     * @return Stackable2dArray
     */
    public function addValues($key, iterable $values): Stackable2dArray
    {
        foreach ($values as $value) {
            $this->addValue($key, $value);
        }
        return $this;
    }

    /**
     * @param string|int $key
     * @param mixed $value
     * @return Stackable2dArray
     */
    public function addValue($key, $value): Stackable2dArray
    {
        $this->getData($key)->addValue($value);
        return $this;
    }
}
