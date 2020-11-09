<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class CalendarTest extends TestCase
{
    public function testJalaliDateTime()
    {
        $pasoonate = Pasoonate::make();
        $date = $pasoonate->jalali()->parse('yyyy/MM/dd HH:mm:ss', '1399/10/12 20:12:00')->format('yyyy/MM/dd HH:mm:ss');

        $this->assertEquals($date, '1399/10/12 20:12:00', 'Jalali Date is ok');
    }
}