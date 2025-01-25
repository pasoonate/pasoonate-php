<?php

declare(strict_types=1);

namespace Pasoonate;

class Constants
{
	const J1970 = 2440587.5; // Julian date at Unix epoch = 1970-01-01
	const SATURDAY = 0;
	const SUNDAY = 1;
	const MONDAY = 2;
	const TUESDAY = 3;
	const WEDNESDAY = 4;
	const THURSDAY = 5;
	const FRIDAY = 6;
	const YEARS_PER_CENTURY = 100;
	const YEARS_PER_DECADE = 10;
	const MONTHS_PER_YEAR = 12;
	const WEEKS_PER_YEAR = 52;
	const DAYS_PER_WEEK = 7;
	const HOURS_PER_DAY = 24;
	const MINUTES_PER_HOUR = 60;
	const SECONDS_PER_MINUTE = 60;
	const HOUR_IN_SECONDS = 3600;
	const DAY_IN_SECONDS = 86400;
	const WEEK_IN_SECONDS = 604800;
	const MONTH_IN_SECONDS = 2629743;
	const YEAR_IN_SECONDS = 31556926;
	const MONTH_IN_DAYS = 30.44;
	const YEAR_IN_DAYS = 365.24;
	const SHIA_EPOCH = 1948439.5;
	const JALALI_EPOCH = 1948320.5;
	const GREGORIAN_EPOCH = 1721425.5;
	const ISLAMIC_EPOCH = 1948439.5;
	const DAYS_OF_ISLAMIC_YEAR = 354;
	const DAYS_OF_SHIA_YEAR = 354;
	const DAYS_OF_JALALI_YEAR = 365;
	const DAYS_OF_TROPICAL_JALALI_YEAR = 365.24219878;
	const DAYS_OF_GREGORIAN_YEAR = 365;
	const GREGORIAN = 'gregorian';
	const JALALI = 'jalali';
	const SHIA = 'shia';
	const ISLAMIC = 'islamic';
}