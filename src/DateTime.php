<?php

declare(strict_types=1);

namespace Pasoonate;

class DateTime
{
    public function __construct(
        public int $year = 0,
        public int $month = 0,
        public int $day = 0,
        public int $hour = 0,
        public int $minute = 0,
        public int $second = 0
    )
    {
    }
}