<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    public function testJalaliDateTime()
    {
        $pasoonate = Pasoonate::make();

        $this->assertTrue($pasoonate->jalali()->setDate(1399,11,10)->isFriday());

        $this->assertTrue($pasoonate->jalali()->setDate(1399,1,1)->isLeapYear());

        $this->assertEquals($pasoonate->jalali('1398/12/10')->format('yyyy/MM/dd'), '1398/12/10', 'Jalali Date is ok');
    }

    public function testGregorianDateTime()
    {
        $pasoonate = Pasoonate::make();

        $this->assertTrue($pasoonate->gregorian()->setDate(2021,02,05)->isFriday());

        $this->assertEquals($pasoonate->gregorian('2021/02/05')->format('yyyy/MM/dd'), '2021/02/05', 'Jalali Date is ok');
    }
}