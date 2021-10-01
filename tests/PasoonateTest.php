<?php

use Pasoonate\Pasoonate;
use PHPUnit\Framework\TestCase;

class PasoonateTest extends TestCase
{
    public function testParser()
    {
        $pasoonate = Pasoonate::make();
        $date = $pasoonate->jalali()->parse('yyyy/MM/dd HH:mm:ss', '1399/10/12 20:12:00')->format('yyyy/MM/dd HH:mm:ss');

        $this->assertEquals($date, '1399/10/12 20:12:00', 'Jalali Date is ok');
    }

    public function testGaregorianParser()
    {
        $pasoonate = Pasoonate::make();
        $pasoonate->gregorian()->parse('yyyy-MM-dd HH:mm:dd', '2021-10-01 13:21:25');

        $date = $pasoonate->jalali()->format('dddd, dd MMMM yyyy - H:m');

        $this->assertEquals($date, 'دوشنبه, 03 آبان 1400 - 13:21', 'Garegorian Date is ok');
    }
}