<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class JalaliCalendarTest extends TestCase
{
    public function testLeapYear()
    {
        $pasoonate = Pasoonate::make();

        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2025/03/20 00:00:00')->jalali()->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1403/12/30 00:00:00', 'Jalali leap year is ok');
    }

    public function testStartOfMonth()
    {
        $pasoonate = Pasoonate::make();
        
        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2024/12/21 00:00:00')->jalali()->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1403/10/01 00:00:00', 'Jalali start month is ok');

        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2025/01/20 00:00:00')->jalali()->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1403/11/01 00:00:00', 'Jalali start month is ok');

        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2025/02/19 00:00:00')->jalali()->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1403/12/01 00:00:00', 'Jalali start month is ok');

        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2025/03/21 00:00:00')->jalali()->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1404/01/01 00:00:00', 'Jalali start month is ok');

        $date = $pasoonate->gregorian()->parse('yyyy/MM/dd HH:mm:ss', '2025/04/21 00:00:00')->jalali()->format('yyyy/MM/dd HH:mm:ss');
        $this->assertEquals($date, '1404/02/01 00:00:00', 'Jalali start month is ok');
    }
}
