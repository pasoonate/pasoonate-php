<?php

namespace MahdiBagheri\Pasoonate;

class Pasoonate extends Constants
{
    public static function make($timestamp = null, $timezoneOffset = null)
    {
        return new CalendarManager($timestamp, $timezoneOffset);
    }
}