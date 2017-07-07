# piper-php
Puts an end to unreadable PHP code.

```php
use Khalyomede\Piper;
use You\PiperArrayFilterNumber as ArrayFIlterNumber;
use Her\PiperArrayAverage as ArrayAverage;

Piper::set([12, 8, 'apple', 19, 16, 'kiwi', 'banana'])
  ->pipe( ArrayFilterNumber::do() )
  ->pipe( ArrayAverage::do() )
  ->echo();
  
// 13.75
```
## Features
- Cascading input-output pipe logic 
- Possibility to echo or get the final result
- Large possibilites with either custom functions or Piper Market classes
- Recursive pipe call

## Why should I use Piper ?
If you want to use a global class that let you mix multiple logic, from local functions to custom Class, by market Classes to PHP functions, and you are eager to build beautiful, readable, and reusable code, Piper-PHP is made for you.

## Can I do a port of Piper-PHP in another language ?
Yes for sure, we even encourage this ! We want to build a better developper experience (DX), so feel free to copy and adapt this concept ! Sharing is caring.

## Who initiated the project ?
Me and my brother, [aminnairi](https://github.com/aminnairi). 

## Why creating Piper ?
We literally fell in love with [Gulp.js](http://gulpjs.com/), which is a task automater that is famous for simplifying your front process, like minifying, processing files, ... And we searched the first pages to hopefuly find a repository for using pipes in PHP but did not find anything ! So we wanted to made it for you guys :)

## How to install it without Composer ?
Worry no more, Piper-PHP got you covered. Simply copy the content of the file `/src/piper.php`, removes the `namespace Khalyomede;` and include this file in your project. You are good to go !

## How to install it using Composer ?
Run the following command in your project folder :
```bash
composer require khalyomede/piper-php
```

## Example 1 : using Piper PHP Market class
_coming soon_

## Example 2 : using custom function
_coming soon_

## Example 3 : mixing custom functions, PHP functions and Piper Market class
_coming soon_

## Example 4 : without initial `set` method
_coming soon_

## Example 5 : using `echo` instead of `get`
_coming soon_

## Piper Market classes
_coming soon_

## Build my Piper class
_coming soon_