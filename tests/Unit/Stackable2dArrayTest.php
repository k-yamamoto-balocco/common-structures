<?php

namespace GitBalocco\CommonStructures\Tests\Unit;

use GitBalocco\CommonStructures\Stackable2dArray;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \GitBalocco\CommonStructures\Stackable2dArray
 * GitBalocco\CommonStructures\Tests\Unit\Stackable2dArrayTest
 */
class Stackable2dArrayTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = Stackable2dArray::class;

    /**
     * @covers ::addValue
     * @covers ::get
     * @covers ::all
     * @covers ::getData
     */
    public function test_add_get_all()
    {
        $targetClass = new $this->testClassName();
        //key1
        $targetClass->addValue('key1', 'value1 of key1');
        $targetClass->addValue('key1', 'value2 of key1');
        //key2
        $targetClass->addValue('key2', 'value1 of key2');
        //key3
        $targetClass->addValue('key3', null);

        //assertion key1
        $this->assertSame(['value1 of key1', 'value2 of key1'], $targetClass->get('key1'));
        //assertion key2
        $this->assertSame(['value1 of key2'], $targetClass->get('key2'));
        //assertion key3
        $this->assertSame([null], $targetClass->get('key3'));

        //all
        $this->assertSame(
            [
                'key1' => ['value1 of key1', 'value2 of key1'],
                'key2' => ['value1 of key2'],
                'key3' => [null],
            ],
            $targetClass->all()
        );
    }

    /**
     * @covers ::getIterator
     */
    public function test_getIterator()
    {
        $targetClass = new $this->testClassName();
        //key1
        $targetClass->addValue('key1', '1');
        $targetClass->addValue('key1', '2');
        //key2
        $targetClass->addValue('key2', '3');
        //key3
        $targetClass->addValue('key3', '4');

        foreach ($targetClass as $key => $value) {
            $this->assertIsArray($value);
            $actual[$key] = $value;
        }

        $this->assertSame(['1', '2'], $actual['key1']);
        $this->assertSame(['3'], $actual['key2']);
        $this->assertSame(['4'], $actual['key3']);
    }

    /**
     * @covers ::addValues
     */
    public function test_addValues()
    {
        $targetClass = new $this->testClassName();

        $array = [1, 2, 3];

        $generator = new class() implements \IteratorAggregate {
            public function getIterator()
            {
                $array = [4, 5, 6];
                foreach ($array as $key => $item) {
                    yield $item;
                }
            }
        };

        $iterator = new class() implements \IteratorAggregate {
            public function getIterator()
            {
                return new \ArrayIterator([7, 8, 9]);
            }
        };
        //テスト対象メソッドの実行
        $targetClass->addValues('key1-array', $array);
        $targetClass->addValues('key2-generator', $generator);
        $targetClass->addValues('key3-iterator', $iterator);

        $this->assertSame([1, 2, 3], $targetClass->get('key1-array'));
        $this->assertSame([4, 5, 6], $targetClass->get('key2-generator'));
        $this->assertSame([7, 8, 9], $targetClass->get('key3-iterator'));
    }
}
