<?php

namespace GitBalocco\CommonStructures\Tests\Unit;

use GitBalocco\CommonStructures\StackableArray;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @coversDefaultClass \GitBalocco\CommonStructures\StackableArray
 * GitBalocco\CommonStructures\Tests\Unit\ValueObject\StackableArrayTest
 */
class StackableArrayTest extends TestCase
{
    /** @var $testClassName as test target class name */
    protected $testClassName = StackableArray::class;

    /**
     * @covers ::addValue
     */
    public function test_addValue()
    {
        $targetClass = new $this->testClassName();
        $targetClass->addValue('aaa');
        $this->assertSame('aaa', $targetClass[0]);
        $targetClass->addValue('bbb');
        $this->assertSame('bbb', $targetClass[1]);
    }


    /**
     * @covers ::addValues
     */
    public function test_addValues()
    {
        $targetClass = new $this->testClassName();
        $stdObject = new stdClass();
        $argIterable = [1, 'string', true, $stdObject];
        $targetClass->addValues($argIterable);

        $this->assertSame(1, $targetClass[0]);
        $this->assertSame('string', $targetClass[1]);
        $this->assertSame(true, $targetClass[2]);
        $this->assertSame($stdObject, $targetClass[3]);
    }
}
