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
use GitBalocco\CommonStructures\Collection\Primitive\CallbackValueCollection;
use GitBalocco\CommonStructures\Collection\ValueCollectionInterface;
use GitBalocco\CommonStructures\Value\Primitive\CallbackValue;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \GitBalocco\CommonStructures\Collection\Primitive\CallbackValueCollection
 */
class CallbackValueCollectionTest extends TestCase
{
    /**
     * test__construct
     * @coversNothing
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct()
    {
        $targetClass = new CallbackValueCollection();
        $this->assertInstanceOf(AbstractValueCollection::class, $targetClass);
        $this->assertInstanceOf(ValueCollectionInterface::class, $targetClass);
    }

    /**
     * test_getResultAsArray
     * @covers ::getResultAsArray
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_getResultAsArray()
    {
        $targetClass = new CallbackValueCollection();

        $targetClass->put(
            'one',
            new CallbackValue(function () {
                return 100;
            })
        );
        $targetClass->put(
            'two',
            new CallbackValue(function () {
                return 200;
            })
        );
        $targetClass->put(
            'three',
            new CallbackValue(function () {
                return 300;
            })
        );
        $this->assertSame(['one' => 100, 'two' => 200, 'three' => 300], $targetClass->getResultAsArray());
    }


}