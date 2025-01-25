<?php

declare(strict_types=1);

namespace Pasoonate\Formatters;

use Pasoonate\Pasoonate;

class SimpleDateFormat extends DateFormat
{
    const FULL_YEAR = 'yyyy';
    const SHORT_YEAR = 'yy';
    const FULL_MONTH_NAME = 'MMMM';
    const SHORT_MONTH_NAME = 'MMM';
    const FULL_MONTH = 'MM';
    const SHORT_MONTH = 'M';
    const SHORT_DAY_NAME = 'ddd';
    const FULL_DAY_NAME = 'dddd';
    const FULL_DAY = 'dd';
    const SHORT_DAY = 'd';
    const FULL_HOUR = 'HH';
    const SHORT_HOUR = 'H';
    const FULL_MINUTE = 'mm';
    const SHORT_MINUTE = 'm';
    const FULL_SECOND = 'ss';
    const SHORT_SECOND = 's';

    public function __construct()
    {
        parent::__construct();
    }

    public function format(string $pattern,string $locale):string
    {
        return $this->compile($pattern, $locale);
    }

    public function compile(string $pattern, string $locale): string
    {
        $categories = [];
        $prevChar = '';
        $currChar = '';
        $index = 0;

        for ($i = 0; $i < strlen($pattern); $i++) {
            $currChar = $pattern[$i];

            if ($currChar === '') {
                continue;
            }

            if ($currChar === $prevChar) {
                $categories[$index] .= $currChar;
            } else {
                $categories[++$index] = $currChar;
            }

            $prevChar = $currChar;
        }
        foreach ($categories as $key => $value) {
            switch ($value) {
                case self::FULL_YEAR:
                    $categories[$key] = $this->getCalendar()->getYear();
                    break;
                case self::SHORT_YEAR:
                    $categories[$key] = substr(strval($this->getCalendar()->getYear()), -2, 2);
                    break;
                case self::FULL_MONTH_NAME:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.month_name.{$this->getCalendar()->getMonth()}", $locale);
                    break;
                case self::SHORT_MONTH_NAME:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.short_month_name.{$this->getCalendar()->getMonth()}", $locale);
                    break;
                case self::FULL_MONTH:
                    $categories[$key] = $this->getCalendar()->getMonth() > 9 ? $this->getCalendar()->getMonth() : "0{$this->getCalendar()->getMonth()}";
                    break;
                case self::SHORT_MONTH:
                    $categories[$key] = $this->getCalendar()->getMonth();
                    break;
                case self::FULL_DAY_NAME:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.day_name.{$this->getCalendar()->dayOfWeek()}", $locale);
                    break;
                case self::SHORT_DAY_NAME:
                    $categories[$key] = Pasoonate::trans("{$this->getCalendar()->name()}.short_day_name.{$this->getCalendar()->dayOfWeek()}", $locale);
                    break;
                case self::FULL_DAY:
                    $categories[$key] = $this->getCalendar()->getDay() > 9 ? $this->getCalendar()->getDay() : "0{$this->getCalendar()->getDay()}";
                    break;
                case self::SHORT_DAY:
                    $categories[$key] = $this->getCalendar()->getDay();
                    break;
                case self::FULL_HOUR:
                    $categories[$key] = $this->getCalendar()->getHour() > 9 ? $this->getCalendar()->getHour() : "0{$this->getCalendar()->getHour()}";
                    break;
                case self::SHORT_HOUR:
                    $categories[$key] = $this->getCalendar()->getHour();
                    break;
                case self::FULL_MINUTE:
                    $categories[$key] = $this->getCalendar()->getMinute() > 9 ? $this->getCalendar()->getMinute() : "0{$this->getCalendar()->getMinute()}";
                    break;
                case self::SHORT_MINUTE:
                    $categories[$key] = $this->getCalendar()->getMinute();
                    break;
                case self::FULL_SECOND:
                    $categories[$key] = $this->getCalendar()->getSecond() > 9 ? $this->getCalendar()->getSecond() : "0{$this->getCalendar()->getSecond()}";
                    break;
                case self::SHORT_SECOND:
                    $categories[$key] = $this->getCalendar()->getSecond();
                    break;
            }
        }

        return join('', $categories);
    }
}