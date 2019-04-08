<?php
use Pasoonate\Pasoonate;

require_once 'vendor/autoload.php';

$pasoonate = Pasoonate::make(time(), 4.5 * 60 * 60);

echo $pasoonate->gregorian()->format('yyyy-MM-dd HH:mm:ss');
echo PHP_EOL;
echo $pasoonate->jalali()->format('yyyy-MM-dd HH:mm:ss');
echo PHP_EOL;
echo $pasoonate->islamic()->format('yyyy-MM-dd HH:mm:ss');
echo PHP_EOL;
echo $pasoonate->shia()->format('yyyy-MM-dd HH:mm:ss');