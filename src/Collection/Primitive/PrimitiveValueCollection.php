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

namespace GitBalocco\CommonStructures\Collection\Primitive;

use GitBalocco\CommonStructures\Collection\AbstractValueCollection;
use GitBalocco\CommonStructures\Collection\Exception\NotPrimitiveValueException;
use GitBalocco\CommonStructures\Collection\ValueCollectionInterface;
use GitBalocco\CommonStructures\Value\PrimitiveValueInterface;

/**
 * PrimitiveValueCollection
 *
 * @package GitBalocco\CommonStructures\Collection\Primitive
 */
abstract class PrimitiveValueCollection extends AbstractValueCollection
{
    public function __construct(array $items = [])
    {
        if (!is_subclass_of($this->valueClass(), PrimitiveValueInterface::class)) {
            throw new NotPrimitiveValueException($this->valueClass());
        }
        parent::__construct($items);
    }

    public function add($item): ValueCollectionInterface
    {
        return parent::add($this->createInstanceByPrimitiveVar($item));
    }

    public function put($key, $item): ValueCollectionInterface
    {
        return parent::put($key, $this->createInstanceByPrimitiveVar($item));
    }

    public function toArray(): array
    {
        $tmp = [];
        foreach ($this->collection as $key => $item) {
            $tmp[$key] = $item->getValue();
        }
        return $tmp;
    }

    private function createInstanceByPrimitiveVar($item)
    {
        $className = $this->valueClass();
        return new $className($item);
    }
}