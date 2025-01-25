<?php

declare(strict_types=1);

namespace Pasoonate\Parsers;

use Pasoonate\Pasoonate;

class SimpleParser extends Parser
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

    public function parse(string $format, string $text): void
    {
        $result = $this->translate($format);
        $components = $this->match($result['pattern'], $text, $result['sequence']);

        $calendar = $this->getCalendar();

        $dateTime = $calendar->getDateTime();

        foreach ($components as $key => $value) {
            switch ($key) {
                case self::FULL_YEAR:
                case self::SHORT_YEAR:
                    $dateTime->year = (int)$value;
                    break;
                case self::FULL_MONTH:
                case self::SHORT_MONTH:
                    $dateTime->month = (int)$value;
                    break;
                case self::FULL_DAY:
                case self::SHORT_DAY:
                    $dateTime->day = (int)$value;
                    break;
                case self::FULL_HOUR:
                case self::SHORT_HOUR:
                    $dateTime->hour = (int)$value;
                    break;
                case self::FULL_MINUTE:
                case self::SHORT_MINUTE:
                    $dateTime->minute = (int)$value;
                    break;
                case self::FULL_SECOND:
                case self::SHORT_SECOND:
                    $dateTime->second = (int)$value;
                    break;
                case self::FULL_MONTH_NAME:
                    $names = Pasoonate::trans($calendar->name() . '.month_name');
                    $month = array_search($value, $names);

                    if ($month > 0) {
                        $dateTime->month = $month;
                    }
                    break;
                case self::SHORT_MONTH_NAME:
                    $names = Pasoonate::trans($calendar->name() . '.short_month_name');
                    $month = array_search($value, $names);

                    if ($month > 0) {
                        $dateTime->month = $month;
                    }
                    break;
                case self::FULL_DAY_NAME:
                    // $names = Pasoonate::trans($calendar->name() . '.day_name');

                    break;
                case self::SHORT_DAY_NAME:
                    // $names = Pasoonate::trans($calendar->name() . '.short_day_name');

                    break;
            }
        }

        $calendar->setDateTime($dateTime->year, $dateTime->month, $dateTime->day, $dateTime->hour, $dateTime->minute, $dateTime->second);
    }

    public function translate(string $format): array
    {
        $categories = [];
        $sequence = [];
        $prevChar = '';
        $currChar = '';
        $pattern = '';
        $index = 0;
        $patterns = [
            self::FULL_YEAR => '(\d{4})',
            self::SHORT_YEAR => '(\d{2})',
            self::FULL_MONTH_NAME => '(\D+)',
            self::SHORT_MONTH_NAME => '(\D+)',
            self::FULL_MONTH => '(\d{2})',
            self::SHORT_MONTH => '(\d{1,2})',
            self::FULL_DAY_NAME => '(\D+)',
            self::SHORT_DAY_NAME => '(\D+)',
            self::FULL_DAY => '(\d{2})',
            self::SHORT_DAY => '(\d{1,2})',
            self::FULL_HOUR => '(\d{2})',
            self::SHORT_HOUR => '(\d{1,2})',
            self::FULL_MINUTE => '(\d{2})',
            self::SHORT_MINUTE => '(\d{1,2})',
            self::FULL_SECOND => '(\d{2})',
            self::SHORT_SECOND => '(\d{1,2})',
        ];

        for ($i = 0; $i < strlen($format); $i++) {
            $currChar = $format[$i];

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
            if (isset($patterns[$value])) {
                $categories[$key] = $patterns[$value];
                $sequence[] = $value;
            }
        }

        $pattern = implode('', $categories);
        $pattern = str_replace(['/', '.'], ['\/', '\.'], $pattern);

        return [
            'pattern' => "/$pattern/",
            'sequence' => $sequence
        ];
    }

    public function match(string $pattern, string $text, array $sequence): array
    {
        if (!preg_match($pattern, $text, $matches)) {
            return [];
        }

        $components = [];

        for ($i = 1; $i < count($matches); $i++) {
            $components[$sequence[$i - 1]] = $matches[$i];
        }

        return $components;
    }
}