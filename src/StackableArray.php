<?php

declare(strict_types=1);

namespace GitBalocco\CommonStructures;

use SplFixedArray;

/**
 * Class StackableArray
 * @package GitBalocco\CommonStructures\ValueObject
 */
class StackableArray extends SplFixedArray
{
    /**
     * @param iterable $values
     * @return StackableArray
     */
    public function addValues(iterable $values): StackableArray
    {
        foreach ($values as $value) {
            $this->addValue($value);
        }
        return $this;
    }

    /**
     * @param mixed $value
     * @return StackableArray
     */
    public function addValue($value): StackableArray
    {
        $size = $this->getSize();
        $this->setSize($size + 1);
        $this->offsetSet($size, $value);
        return $this;
    }
}
