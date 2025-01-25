<?php

declare(strict_types=1);

namespace Pasoonate;

class Date
{
    public function __construct(
        public int $year = 0,
        public int $month = 0,
        public int $day = 0
    )
    {
    }
}