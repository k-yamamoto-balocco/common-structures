<?php

/**
 * Balocco Inc.
 * ～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～
 * 株式会社バロッコはシステム設計・開発会社として、
 * 社員・顧客企業・パートナー企業と共に企業価値向上に全力を尽くします
 *
 * 1. プロフェッショナル集団として人間力・経験・知識を培う
 * 2. システム設計・開発を通じて、顧客企業の成長を活性化する
 * 3. 顧客企業・パートナー企業・弊社全てが社会的意義のある事業を営み、全てがwin-winとなるビジネスをする
 * ～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～～
 * 本社所在地
 * 〒101-0032　東京都千代田区岩本町2-9-9 TSビル4F
 * TEL:03-6240-9877
 *
 * 大阪営業所
 * 〒530-0063　大阪府大阪市北区太融寺町2-17 太融寺ビル9F 902
 *
 * https://www.balocco.info/
 * © Balocco Inc. All Rights Reserved.
 */

namespace GitBalocco\CommonStructures\Collection;

use Generator;
use GitBalocco\CommonStructures\Collection\Exception\InvalidItemTypeException;


abstract class AbstractValueCollection implements ValueCollectionInterface
{
    protected array $collection = [];

    public function __construct(array $items = [])
    {
        $this->addArray($items);
    }

    abstract protected static function valueClass(): string;

    /**
     * add
     *
     * @psalm-suppress MissingParamType
     * @psalm-suppress InvalidStringClass
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function add($item): ValueCollectionInterface
    {
        if (!is_a($item, $this->valueClass())) {
            throw new InvalidItemTypeException($item, $this->valueClass());
        }
        $this->collection[] = $item;
        return $this;
    }

    /**
     * put
     *
     * @psalm-suppress MissingParamType
     * @psalm-suppress InvalidStringClass
     * @param $key
     * @param $item
     * @return ValueCollectionInterface
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function put($key, $item): ValueCollectionInterface
    {
        if (!is_a($item, $this->valueClass())) {
            throw new InvalidItemTypeException($item, $this->valueClass());
        }
        $this->collection[$key] = $item;
        return $this;
    }

    /**
     * addArray
     *
     * @psalm-suppress MissingParamType
     * @param array $items
     * @return ValueCollectionInterface
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function addArray(array $items): ValueCollectionInterface
    {
        foreach ($items as $item) {
            $this->add($item);
        }
        return $this;
    }

    public function putArray(array $items): ValueCollectionInterface
    {
        foreach ($items as $key => $item) {
            $this->put($key, $item);
        }
        return $this;
    }

    public function toArray(): array
    {
        $tmp = [];
        foreach ($this->collection as $key => $item) {
            $tmp[$key] = $item;
        }
        return $tmp;
    }

    public function getIterator(): Generator
    {
        foreach ($this->collection as $key => $item) {
            yield $key => $item;
        }
    }

    public function count(): int
    {
        return count($this->collection);
    }

    public function flush(): ValueCollectionInterface
    {
        $this->collection = [];
        return $this;
    }
}
