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

namespace GitBalocco\CommonStructures\Test\Unit\Collection\Primitive;

use GitBalocco\CommonStructures\Collection\AbstractValueCollection;
use GitBalocco\CommonStructures\Collection\Primitive\BoolValueCollection;
use GitBalocco\CommonStructures\Collection\ValueCollectionInterface;
use GitBalocco\CommonStructures\Value\Exception\InitializeValueException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \GitBalocco\CommonStructures\Collection\Primitive\BoolValueCollection
 */
class BoolValueCollectionTest extends TestCase
{
    /**
     * test__construct
     * @coversNothing
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct()
    {
        $targetClass = new BoolValueCollection();
        $this->assertInstanceOf(AbstractValueCollection::class, $targetClass);
        $this->assertInstanceOf(ValueCollectionInterface::class, $targetClass);
    }

    /**
     * test__isTrue
     * @covers ::isAllTrue
     * @dataProvider dataProviderIsTrue
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_isAllTrue($expected, $argArray)
    {
        $targetClass = new BoolValueCollection();
        $targetClass->addArray($argArray);
        $this->assertSame($expected, $targetClass->isAllTrue());
    }

    /**
     * test__isTrue
     * @covers ::isAllFalse
     * @dataProvider dataProviderIsFalse
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_isAllFalse($expected, $argArray)
    {
        $targetClass = new BoolValueCollection();
        $targetClass->addArray($argArray);
        $this->assertSame($expected, $targetClass->isAllFalse());
    }

    public function dataProviderIsTrue(): array
    {
        return [
            [true, [true, true]],
            [false, [true, false]],
            [false, [false, true]],
            [false, [false, false]],

            [true, [true, true, true]],
            [false, [true, true, false]],
            [false, [true, false, true]],
            [false, [false, true, true]],
            [false, [true, false, false]],
            [false, [false, true, false]],
            [false, [false, false, true]],
            [false, [false, false, false]],
        ];
    }

    public function dataProviderIsFalse(): array
    {
        return [
            [true, [false, false]],
            [false, [true, false]],
            [false, [false, true]],
            [false, [true, true]],

            [false, [true, true, true]],
            [false, [true, true, false]],
            [false, [true, false, true]],
            [false, [false, true, true]],
            [false, [true, false, false]],
            [false, [false, true, false]],
            [false, [false, false, true]],
            [true, [false, false, false]],
        ];
    }


}