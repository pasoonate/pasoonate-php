<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class PasoonateTest extends TestCase
{
    public function testJalaliParser()
    {
        $pasoonate = Pasoonate::make();
        $date = $pasoonate->jalali()->parse('yyyy/MM/dd HH:mm:ss', '1404/01/01 20:12:00')->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1404/01/01 20:12:00', 'Jalali Date is ok');
    }

    public function testGregorianParser()
    {
        $pasoonate = Pasoonate::make();
        $time = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2023/02/12 14:00:00')->format('HH:mm');
        $this->assertEquals($time, '14:00', 'Gregorian Time is ok');

        $pasoonate = Pasoonate::make();
        $time = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2023/02/12 14:20:00')->format('HH:mm');
        $this->assertEquals($time, '14:20', 'Gregorian Time is ok');

        $pasoonate = Pasoonate::make();
        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2025/01/23 14:20:00')->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '2025/01/23 14:20:00', 'Gregorian Date is ok');
    }

    public function testCalendarConvert()
    {
        $pasoonate = Pasoonate::make();
        $date = $pasoonate->gregorian()->parse('yyyy-MM-dd HH:mm:dd', '2025-01-23 13:21:25')->jalali()->format('dddd, dd MMMM yyyy - H:m');
        $this->assertEquals($date, 'پنج‌شنبه, 04 بهمن 1403 - 13:21', 'Garegorian to Jalali is ok');

        $pasoonate = Pasoonate::make();
        $date = $pasoonate->gregorian("2023-02-03 23:59:58")->jalali()->format('yyyy-MM-dd');
        $this->assertEquals($date, '1401-11-14');
    }
}
