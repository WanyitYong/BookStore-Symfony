<?php
namespace App\Tests;

use Codeception\Test\Unit;
class FirstUnitTest extends Unit
{
    public function test()
    {
        $num1 = 1;
        $num2 = 1;
        $expectedResult = 2;

        $result = $num1 + $num2;
        $this->assertEquals($expectedResult, $result);
    }
}