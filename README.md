# piper-php
Puts an end to unreadable PHP code.

```php
use Khalyomede\Piper;
use You\PiperArrayFilterNumber as ArrayFIlterNumber;
use Her\PiperArrayAverage as ArrayAverage;

Piper::set([12, 8, 'apple', 19, 16, 'kiwi', 'banana'])
  ->pipe( ArrayFilterNumber::do() )
  ->pipe( ArrayAverage::do() )
  ->pipe( 'intval' )
  ->pipe( 'addOne' ) // your previously created function
  ->pipe( function() { return Piper::input() + 3; } )
  ->echo();
  
// 17
```
## Features
- Cascading input-output pipe logic 
- Possibility to echo or get the final result
- Large possibilites with either custom functions or Piper Comunity classes
- Recursive pipe call

## Why should I use Piper ?
If you want to use a global class that let you mix multiple logic, from local functions to custom classes, from custom Piper classes to PHP functions, and you are eager to build beautiful, readable, and reusable code, Piper-PHP is made for you. If you love the Gulp.js way, you will love Piper-PHP too !

## Can I do a port of Piper-PHP in another language ?
Yes for sure, we even encourage this ! We want to build a better developper experience (DX), so feel free to copy and adapt this concept ! Sharing is caring.

## Who initiated the project ?
Me and my brother, [aminnairi](https://github.com/aminnairi). 

## Why creating Piper ?
We literally fell in love with [Gulp.js](http://gulpjs.com/), which is a task automater that is famous for simplifying your front process, like minifying, processing files, ... We searched to hopefuly find a repository for using pipes in PHP but did not find anything that fit our needs ! So we wanted to made it for you guys :)

## How to install it without Composer ?
Worry no more, Piper-PHP got you covered. Simply copy the content of the file `/src/piper.php`, removes the `namespace Khalyomede;` and include this file in your project. You are good to go !

## How to install it using Composer ?
Run the following command in your project folder :
```bash
composer require khalyomede/piper-php && composer update
```

## Examples
All the examples will assume you have the following arborescence :
```
/
index.php
vendor/
composer.json
composer.lock
```

## Example 1 : using Piper PHP Community class
_this example features hypotetical classes to illustrate this example_

Download the Piper class of another friend (hypotetical class). Execute this command in your project folder :
```bash
composer require someone/piper-array-average && composer update
```
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;
use Someone\PiperArrayAverage as ArrayAverage;

Piper::set([5, 17, 12, 14, 9])
  ->pipe( ArrayAverage::do() )
  ->echo();
```
This will print :
```bash
11.4
```

## Example 2 : using custom function
```php
function uppercase( $input ) {
  return strtoupper( $input );
}

Piper::set('text')
  ->pipe('uppercase')
  ->echo();
```
This will print :
```bash
TEXT
```

## Example 3 : mixing custom functions, PHP functions and Piper Comunity class
_this example features hyptotetical classes to illustrate this example_

Download the Piper class of another friend (hypotetical class). Execute this command in your project folder :
```bash
composer require someone/piper-array-average && composer update
```
Now let the fun begin :
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;
use Someone\PiperArrayAverage as ArrayAverage;

function convertInt( $input ) {
  return (int) $input;
}

Piper::set([5, 17, 12, 14, 9])
  ->pipe( ArrayAverage::do() )
  ->pipe( 'convertInt' )
  ->pipe( function() { return Piper::input() + 5; } )
  ->echo();
```
This will print : 
```bash
16
```

## Example 4 : without initial `set` method
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;

Piper::pipe( function() { return 'test' } )
  ->pipe('strtoupper')
  ->echo();
```
This will print :
```php
TEST
```

## Example 5 : using `get` instead of `echo`
_coming soon_

## Piper Community classes
_coming soon_

## Build my Piper class
_coming soon_