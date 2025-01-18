<?php

namespace Pasoonate;

class Time
{
    public function __construct(
        public int $hour = 0,
        public int $minute = 0,
        public int $second = 0
    )
    {
    }
}