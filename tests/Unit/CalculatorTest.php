<?php

namespace App\Tests\Unit;

use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    protected $calculator;

    protected function setUp()
    {
        parent::setUp();

        $this->calculator = new Calculator();
    }

    protected function tearDown()
    {
        parent::tearDown();

        $this->calculator = null;
    }


    /**
     * @dataProvider additionDataProvider
     */
    public function testAddition($a, $b, $expected)
    {
        //prepare
        $this->calculator = new Calculator();
        //perform
        $result = $this->calculator->add($a, $b);
        //assert
        $this->assertEquals($expected, $result);
    }


    public function additionDataProvider()
    {
        return [
            [5, 3, 8],
            [8, 12, 20],
            [0, 0, 0],
            [1.4, 2.1, 3.5]
        ];
    }

    /**
     * @dataProvider additionFailDataProvider
     */
    public function testAdditionFailsWithBadInput($a, $b)
    {
        $this->calculator = new Calculator();
        try {
            $this->calculator->add($a, $b);
            $this->assertTrue(false);
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(true);
        }
    }


    public function additionFailDataProvider()
    {
        return [
            ['hello', 'world'],
            [new Calculator(), new Calculator()],
            ['hello', new Calculator()]
        ];
    }

    /**
     * @dataProvider subtractionDataProvider
     */
    public function testSubtraction($a, $b, $expected)
    {
        $this->calculator = new Calculator();
        $result = $this->calculator->subtract($a, $b);

        $this->assertEquals($expected, $result);
    }


    public function subtractionDataProvider()
    {
        return [
            [5, 3, 2],
            [15, 12, 3],
            [0, 0, 0]
        ];
    }

    /**
     * @dataProvider subtractionFailDataProvider
     */
    public function testSubtractionFailsWithBadInput($a, $b)
    {
        $this->calculator = new Calculator();
        try {
            $this->calculator->subtract($a, $b);
            $this->assertTrue(false);
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(true);
        }
    }


    public function subtractionFailDataProvider()
    {
        return [
            ['hello', 'world'],
            [new Calculator(), new Calculator()],
            ['hello', new Calculator()]
        ];
    }
}
