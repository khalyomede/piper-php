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
```
TEST
```

## Example 5 : using `get` instead of `echo`
```php
require __DIR__ . '/vendor/autoload.php';

$uppercase = Piper::set('test')
  ->pipe( 'strtoupper' )
  ->get();

echo $uppercase;
```
This will print :
```bash
TEST
```

## Available Piper methods
- `mixed Piper::input()` : returns the input of the last `Piper::pipe()` or `Piper::set()`. In other terms, get the last item of you Piper chain.
- `void Piper::set( $variable )` : set the input (available via `Piper::input()`) with the variable. It can be any variable possible.
- `void Piper::pipe( callable $function )` : use a callback function to be applied to the input (available via `Piper::input()`). See example above.
- `void Piper::pipe( PiperContract $class )` : use a class that implements the `PiperContract` interface (see Build my Piper class below).
- `void Piper::pipe( callable $string )` : use a PHP function or a previously created function by you to be called on the input (available via `Piper::input()`).
- `void Piper::echo()` : echo the last input (available via `Piper::input()`).
- `mixed Piper::get()` : returns the last input (available via `Piper::input()`).
- `mixed Piper::$input` : get the public static property representing the input.

## Build my Piper class
Follow this steps to be up and runing with your freshly Piper Comunity class and help people do less and better.

### 1. Guidelines
We will give you some tips to do the cleanest Piper Comunity class possible :
#### 1.1 Use Piper before your package name
If you deal with array average, instead of `me/array-average` instead use `me/piper-array-average`. This will improve your SEO and help the comunity to see which composer package deals with Piper.
#### 1.2. Use kebab case for package name
Instead of naming your package `me/piperArrayAverage`, prefer using `me/piper-array-average` for a better readability.
#### 1.3. Use an uppercase and camel case for your class name
A good class name begins with an uppercase letter, and no dashes. An example of good class name would be :
```php
class PiperArrayAverage {}
```
#### 1.4. Use lowercase and kebab case for you class file
If we assume you put your class in folder `src/`, prefer using `src/piper-array-average.php` instead of `src/piperarrayaverage.php`. This will improves the readability.
#### 1.5. Precise you are dealing with PHP in your package description
Let the users know, since it may not be visible in your package name.
#### 1.6. Use PHP pre-requisit >= 5.3.0
Set up your `composer.json` `require` attribute to at least `5.3.0` as the classes will use namespaces. For example, you `composer.json` could looks like this :
```json
{
    "name": "me/piper-array-average",
    "description": "Piper Comunity class that returns the average of numeric values in an array.",
    "type": "library",
    "license": "MIT",
    "minimum-stability": "stable",
    "require": {
    	"php": ">=5.3.0"
    },
    "autoload": {
    	"psr-4": {
    		"Me\\": "src/"
    	}
    }
}
```
#### 1.7. Name your test file `getting-started.php`
This will let the user instantly know that it can rely on this file to learn more on the usage of your class.
#### 1.8. Prefer example instead of long descriptive method text
Users want to get quicly started and, mostly on the web, will cease to read if the description gets too long or too broad. Prefer short and explicit example than short descriptives text.
### 2. Create your folder
_coming soon_
### 3. Open a command line and initiate Git
_coming soon_
### 4. Initiate Composer
_coming soon_
### 5. Create a `src` folder with your class inside
_coming soon_
### 6. Create a `test` folder with a `getting-started.php` file inside
_coming soon_
## Need more ?
Feel free to do a Pull Request and let us know which feature you would like to see the most.