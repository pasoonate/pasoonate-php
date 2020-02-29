<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    public function testJalaliDateTime()
    {
        $pasoonate = Pasoonate::make();

        $this->assertEquals($pasoonate->jalali('1398/12/10')->format('yyyy/MM/dd'), '1398/12/10', 'Jalali Date is ok');
    }
}