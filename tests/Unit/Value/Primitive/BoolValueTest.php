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
use GitBalocco\CommonStructures\Value\Primitive\BoolValue;
use GitBalocco\CommonStructures\Value\Value;
use GitBalocco\CommonStructures\Value\ValueInterface;
use PHPUnit\Framework\TestCase;

/**
 * BoolValueTest
 * @coversDefaultClass \GitBalocco\CommonStructures\Value\Primitive\BoolValue
 * @package GitBalocco\CommonStructures\Tests\Unit\Value\Primitive
 */
class BoolValueTest extends TestCase
{
    /**
     * test__construct_正常系
     * @coversNothing
     * @dataProvider dataProviderNormalCase
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct_normalCase($valueCandidate)
    {
        $value = new BoolValue($valueCandidate);
        $this->assertInstanceOf(Value::class, $value);
        $this->assertInstanceOf(ValueInterface::class, $value);
    }

    /**
     * test_getValue
     * @covers ::getValue
     * @dataProvider dataProviderNormalCase
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_getValue($valueCandidate)
    {
        $value = new BoolValue($valueCandidate);
        $this->assertSame($valueCandidate, $value->getValue());
    }

    /**
     * test_getValue
     * @covers ::is
     *
     * @dataProvider dataProviderNormalCase
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test_is($valueCandidate)
    {
        $value = new BoolValue($valueCandidate);

        $this->assertSame($value->is(), $valueCandidate);
    }

    /**
     * test__construct_OccursInitializeValueException
     * @coversNothing
     * @dataProvider dataProviderOccursInitializeValueException
     * @author kenji yamamoto <k.yamamoto@balocco.info>
     */
    public function test__construct_OccursInitializeValueException($valueCandidate)
    {
        $this->expectException(InitializeValueException::class);
        new BoolValue($valueCandidate);
    }

    protected function dataProviderNormalCase(): array
    {
        return [
            [true],
            [false]
        ];
    }

    protected function dataProviderOccursInitializeValueException(): array
    {
        return [
            [0],
            [1],
            [123456],
            [0.1],
            ['aaaa'],
            ['string value'],
            [null],
            [[]],
            [new \stdClass()]
        ];
    }
}