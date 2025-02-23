# 📅 PHP & Laravel Calendar - Pasoonate

Pasoonate is a powerful library that provides advanced date-time methods and supports multiple calendars! 🚀

---

## 🛠 Running Tests
```bash
composer install
./vendor/bin/phpunit
```

## 📥 Installation (via [Composer](https://getcomposer.org))
```bash
composer require pasoonate/pasoonate-php
```

---

## 🎯 Usage
```php
use Pasoonate\Pasoonate;

function pasoonate(): CalendarManager
{
    return Pasoonate::make();
}

// Set timestamp 📌
$date = pasoonate()->setTimestamp(1333857600)->jalali()->format('yyyy-MM-dd');

// Convert Jalali to Gregorian 🌍
$datetime = pasoonate()->jalali('1398/02/01 20:00:00')->gregorian()->getDatetime();

// Get today's date in different calendars 📆
$date = pasoonate()->jalali()->format('yyyy-MM-dd'); // 1403-10-29 🏷️
$date = pasoonate()->gregorian()->format('yyyy-MM-dd'); // 2025-01-18 📅
$date = pasoonate()->islamic()->format('yyyy-MM-dd'); // 1446-07-18 🌙
$date = pasoonate()->shia()->format('yyyy-MM-dd'); // 1446-07-17 ✨

// Date conversion 🔄
$date = pasoonate()->jalali()->addDay(2)->gregorian()->format('yyyy-MM-dd');

// Parse and format dates 📖
pasoonate()->jalali()->parse('yyyy-MM-dd', '1403-10-10')->addDay(3)->format('yyyy-MM-dd'); //1403-10-13
```

---

## 🌍 Supported Calendars
- 📅 **Gregorian**
- 🇮🇷 **Jalali**
- 🕌 **Islamic**
- ⚫ **Shia**

---

## 📌 Commonly Used Date Functions in Projects

### ✅ Get Today's Date
```php
$today = pasoonate()->jalali()->format('Y/m/d');
```

### 🔄 Convert Jalali to Gregorian
```php
$gregorianDate = pasoonate()->jalali('1403/10/10')->gregorian()->format('Y-m-d');
```

### 🔁 Convert Gregorian to Jalali
```php
$jalaliDate = pasoonate()->gregorian('2025-01-18')->jalali()->format('Y/m/d');
```

### ⏳ Get Start and End of the Month
```php
$startOfMonth = pasoonate()->jalali()->startOfMonth()->format('Y/m/d');
$endOfMonth = pasoonate()->jalali()->endOfMonth()->format('Y/m/d');
```

### 🕰️ Get Start and End of the Year
```php
$startOfYear = pasoonate()->jalali()->startOfYear()->format('Y/m/d');
$endOfYear = pasoonate()->jalali()->endOfYear()->format('Y/m/d');
```

### 📆 Check Leap Year
```php
$isLeap = pasoonate()->jalali()->isLeapYear(); // Returns true or false
```

### 🗓️ Get Day of the Week
```php
$dayOfWeek = pasoonate()->jalali()->dayOfWeek(); // 0 = Saturday, 6 = Friday
```

### 📅 Get Week Number of the Year
```php
$weekNumber = pasoonate()->jalali()->weekOfYear();
```

---

## 🔑 Basic Methods
- `getTimestamp()` 🕰️
- `getTimezoneOffset()` 🌎
- `getDatetime()` ⏳
- `getDate()` 📆
- `getTime()` ⏰
- `getYear()` 🎯
- `getMonth()` 📅
- `getDay()` 🏷️
- `getHour()` ⏳
- `getMinute()` ⏲️
- `getSecond()` 🕐
- `setTimestamp($timestampAsSeconds)` 🔄
- `setTimezoneOffset($offsetAsMinutes)` 🏝️
- `setDatetime($year, $month, $day, $hour, $minute, $second)` 🏗️
- `setDate($year, $month, $day)`
- `setTime($hour, $minute, $second)`
- `setYear($year)`
- `setMonth($month)`
- `setDay($day)`
- `setHour($hour)`
- `setMinute($minute)`
- `setSecond($second)`
- `setUTCDatetime($year, $month, $day, $hour, $minute, $second)`
- `setUTCDate($year, $month, $day)`
- `setUTCTime($hour, $minute, $second)`
- `setUTCYear($year)`
- `setUTCMonth($month)`
- `setUTCDay($day)`
- `setUTCHour($hour)`
- `setUTCMinute($minute)`
- `setUTCSecond($second)`
- `dayOfWeek()` *(from 0 for Saturday to 6 for Friday)*
- `dayOfYear()`
- `weekOfMonth()`
- `weekOfYear()`

---

## ➕ Addition & ➖ Subtraction Methods

### 📅 Add Year
```php
echo $today->jalali('1399/01/15 11:22:00')->addYear(1)->format('Y/m/d H:i:s');
// 🗓️ 1400/01/15 11:22:00
```

### 📆 Add Month
```php
echo $today->jalali()->addMonth(1)->format('Y/m/d H:i:s');
// 🗓️ 1400/02/15 11:22:00
```

### 📅 Add Day
```php
echo $today->jalali()->addDay(3)->format('Y/m/d H:i:s');
// 🗓️ 1400/02/18 11:22:00
```

### ⏳ Add Hour
```php
echo $today->jalali()->addHour(4)->format('Y/m/d H:i:s');
// ⏳ 1400/02/18 15:22:00
```

### ⏲️ Add Minute
```php
echo $today->jalali()->addMinute(2)->format('Y/m/d H:i:s');
// ⏲️ 1400/02/18 15:24:00
```

### ⏰ Add Second
```php
echo $today->jalali()->addSecond(35)->format('Y/m/d H:i:s');
// ⏰ 1400/02/18 15:24:35
```

### 📅 Subtract Year
```php
echo $today->jalali()->subYear(1)->format('Y/m/d H:i:s');
// 📅 1399/02/18 15:24:35
```

### 📆 Subtract Month
```php
echo $today->jalali()->subMonth(1)->format('Y/m/d H:i:s');
// 📆 1399/01/18 15:24:35
```

### 🗓️ Subtract Day
```php
echo $today->jalali()->subDay(3)->format('Y/m/d H:i:s');
// 🗓️ 1399/01/15 15:24:35
```

... *(and many more!)*

---

🚀 **Pasoonate** makes date handling in PHP and Laravel super easy! 🔥

💡 **Give it a ⭐ on GitHub if you find it useful!** 🌟

