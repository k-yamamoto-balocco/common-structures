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

namespace GitBalocco\CommonStructures\Test\Unit\Value\Primitive;

use GitBalocco\CommonStructures\Value\Exception\InitializeValueException;
use GitBalocco\CommonStructures\Value\Primitive\AbstractIntValue;
use GitBalocco\CommonStructures\Value\Primitive\IntValue;
use GitBalocco\CommonStructures\Value\Value;
use GitBalocco\CommonStructures\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \GitBalocco\CommonStructures\Value\Primitive\AbstractIntValue
 */
class AbstractIntValueTest extends TestCase
{
    /**
     * test__construct_正常系
     * @covers ::validatorClassName
     * @dataProvider dataProviderConstruct
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct($valueCandidate)
    {
        $value = new IntValue($valueCandidate);
        $this->assertInstanceOf(Value::class, $value);
        $this->assertInstanceOf(ValueInterface::class, $value);
        $this->assertInstanceOf(AbstractIntValue::class, $value);
    }

    /**
     * test_getValue
     * @coversNothing
     * @dataProvider dataProviderConstruct
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_getValue($valueCandidate, $expected)
    {
        $value = new IntValue($valueCandidate);
        $this->assertSame($expected, $value->getValue());
    }

    /**
     * test_getValue
     * @covers ::__toString
     * @dataProvider dataProviderConstruct
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test___toString($valueCandidate, $expected)
    {
        $value = new IntValue($valueCandidate);
        $this->assertSame((string)$expected, $value->__toString());
    }

    /**
     * @covers ::validatorClassName
     * @dataProvider dataProviderOccursInitializeValueException
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct_OccursInitializeValueException($valueCandidate)
    {
        $this->expectException(InitializeValueException::class);
        new IntValue($valueCandidate);
    }

    protected function dataProviderConstruct(): array
    {
        return [
            [0, 0],
            [1, 1],
        ];
    }

    protected function dataProviderOccursInitializeValueException(): array
    {
        return [
            ["0"],//string
            ["some string"],//string
            [true],//bool
            [false],//bool
            [null],//null
            [[]],//empty array
            [[1, 2]],
            //an object
            [new \stdClass()]
        ];
    }
}