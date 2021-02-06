<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    public function testJalaliDateTime()
    {
        $pasoonate = Pasoonate::make();

        $this->assertEquals($pasoonate->jalali('1398/12/10')->format('yyyy/MM/dd'), '1398/12/10', 'Jalali Date is ok');

        $this->assertTrue($pasoonate->jalali()->setDate(1399,1,1)->isLeapYear());

        $this->assertTrue($pasoonate->jalali()->setDate(1399,11,17)->isFriday());

        $this->assertTrue($pasoonate->jalali()->setDate(1399,11,11)->dayOfWeek() === 0);

        $this->assertTrue($pasoonate->jalali()->setDate(1399,1,11)->dayOfYear() === 11);

        $this->assertTrue($pasoonate->jalali()->setDate(1399,12,11)->daysInMonth() === 30);

        $julianDayNumber = $pasoonate->jalali()->setDate(1399,12,11)->getJulianDayNumber();
        $this->assertTrue($pasoonate->jalali()->setJulianDayNumber($julianDayNumber)->gregorian()->getJulianDayNumber() == $julianDayNumber);

        $this->assertEquals($pasoonate->jalali()->setDate(1399,1,31)->addMonth(11)->format('yyyy/MM/dd'), '1399/12/30');
    }

    public function testGregorianDateTime()
    {
        $pasoonate = Pasoonate::make();

        $this->assertTrue($pasoonate->gregorian()->setDate(2021,02,05)->isFriday());

        $this->assertEquals($pasoonate->gregorian('2021/02/05')->format('yyyy/MM/dd'), '2021/02/05', 'Jalali Date is ok');
    }
}