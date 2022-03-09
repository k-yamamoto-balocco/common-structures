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
use GitBalocco\CommonStructures\Collection\Primitive\StringValueCollection;
use GitBalocco\CommonStructures\Collection\ValueCollectionInterface;
use GitBalocco\CommonStructures\Value\Exception\InitializeValueException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \GitBalocco\CommonStructures\Collection\AbstractValueCollection
 */
class StringValueCollectionTest extends TestCase
{
    /**
     * test__construct
     * @covers ::__construct
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct()
    {
        $targetClass = new StringValueCollection();
        $this->assertInstanceOf(AbstractValueCollection::class, $targetClass);
        $this->assertInstanceOf(ValueCollectionInterface::class, $targetClass);
    }

    /**
     * test__construct_occurException
     * @covers ::__construct
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct_occurException()
    {
        $this->expectException(InitializeValueException::class);
        new BoolValueCollection(['stringValue']);
    }

    /**
     * test_add
     *
     * @covers ::add
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_add()
    {
        $targetClass = new StringValueCollection();
        $targetClass->add("1");
        $targetClass->add("2");
        $this->assertSame(['1', '2'], $targetClass->toArray());
    }

    /**
     * @covers ::put
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_put()
    {
        $targetClass = new StringValueCollection();
        $targetClass->put('first-key', "11");
        $targetClass->put('second-key', "12");
        $this->assertSame(['first-key' => '11', 'second-key' => '12'], $targetClass->toArray());
    }

    /**
     * test_add
     *
     * @covers ::add
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_addArray()
    {
        $targetClass = new StringValueCollection();
        $array = ['21', '22'];
        $targetClass->addArray($array);
        $this->assertSame($array, $targetClass->toArray());
    }


}