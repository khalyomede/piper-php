# piper-php
Puts an end to unreadable PHP code.

```php
use Khalyomede\Piper;
use You\ArrayFilterNumber;
use Her\ArrayAverage;

$average = Piper::set([12, 8, 'apple', 19, 16, 'kiwi', 'banana'])
  ->pipe( ArrayFilterNumber::do() )
  ->pipe( ArrayAverage::do() )
  ->get();
  
echo $average; // 13.75
```

## Why should I use Piper ?
If you want to use a global class that let you mix multiple logic, from local functions to custom Class, by market Classes to PHP functions, and you are eager to build beautiful, readable, and reusable code, Piper-PHP is made for you.

## Can I do a port of Piper-PHP in another language ?
Yes for sure, we even encourage this ! We want to build a better developper experience (DX), so feel free to copy and adapt this concept ! Sharing is caring.

## How to install it without Composer ?
Worry no more, Piper-PHP got you covered. Simply copy the content of the file `/src/piper.php`, removes the `namespace Khalyomede;` and include this file in your project. You are good to go !

## How to install it using Composer ?
Run the following command in your project folder :
```bash
composer require khalyomede/piper-php
```

## Example 1 : using Piper PHP Market functions
