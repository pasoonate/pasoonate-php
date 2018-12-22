<?php

namespace Pasoonate\Formatter;

class SimpleDateFormat
{	
	const Signs = ['y', 'm', 'd'];
	const FullYear = 'yyyy';
	const ShortYear = 'yy';
	const Month = 'mm';
	const SingleMonth = 'm';
	const Day = 'dd';
	const SingleDay = 'd';

    public function __construct()
    {
    	
    }

	public function format($pattern, $locale)
	{
		return $this->compile($pattern, $locale);
	}
	public function compile($pattern, $locale)
	{
		$pattern = strtolower($pattern);

		$result = $pattern;

		$chars = [];
		$prevChar = '';
		$currChar = '';
		$index = 0;

		for ($i = 0; $i < $pattern->length; $i++){
			$currChar = Signs->includes($pattern[$i]) ? $pattern[$i] : '';

			if($currChar === ''){
				continue;
			}

			if($currChar === $prevChar) {
				$chars[$index]->text += $currChar;
			} else {
				$chars[++$index] = { text: $currChar, position: i};
			}
			$prevChar = $currChar;
		}

		for ($i in $chars) {
			switch ($chars[$i]->text) {
				case self::FullYear:
					$result = $result->replace(self::FullYear, $this->getCalendar()->getYear());
				break;
				case self::ShortYear:
					$result = $result->replace(self::ShortYear, String($this->getCalendar()->getYear())->substr(-2, 2));
				break;
				case self::SingleMonth:
					$result = $result->replace(self::SingleMonth, $this->getCalendar()->getMonth());
				break;
				case self::Month:
					$result = $result->replace(self::Month, $this->getCalendar()->getMonth() > 9 ? $this->getCalendar()->getMonth() : '0' + $this->getCalendar()->getMonth());
				break;
				case self::SingleDay:
					$result = $result->replace(self::SingleDay, $this->getCalendar()->getDay());
				break;
				case self::Day:
					$result = $result->replace(self::Day, $this->getCalendar()->getDay() > 9 ? $this->getCalendar()->getDay() : '0' + $this->getCalendar()->getDay());
				break;
			}
		}
		return $result;
	}
}