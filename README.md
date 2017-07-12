# piper-php
Puts an end to unreadable PHP code.

```php
use Khalyomede\Piper;
use You\PiperArrayFilterNumber as ArrayFilterNumber;
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

## Why should I use Piper?
If you want to use a global class that let you mix multiple logic, from local functions to custom classes, from custom Piper classes to PHP functions, and you are eager to build beautiful, readable, and reusable codes, then Piper-PHP is made for you. If you love the [Gulp.js](http://gulpjs.com/) way, you will love Piper-PHP too!

## Can I do a port of Piper-PHP in another language?
Yes for sure, we even encourage this! We want to build a better developper experience (DX), so feel free to copy and adapt this concept! Sharing is caring.

## Who initiated the project?
Me and my brother, [aminnairi](https://github.com/aminnairi).

## Why creating Piper?
We literally fell in love with [Gulp.js](http://gulpjs.com/), which is a task automater that is famous for simplifying your front process, like minifying, processing files, ... We searched to hopefuly find a repository for using pipes in PHP but did not find anything that fit our needs! So we wanted to made it for you guys :)

## How to install it without Composer?
Worry no more, Piper-PHP got you covered. Simply copy the content of the file `/src/piper.php`, removes the `namespace Khalyomede;` and include this file in your project. You are good to go!

## How to install it using Composer?
Run the following command in your project folder:
```bash
$ composer require khalyomede/piper-php && composer update
```

## Examples
All the examples will assume you have the following arborescence:
```
/
index.php
vendor/
composer.json
composer.lock
```

## Example 1: using Piper PHP Community class
_this example features hypotetical classes to illustrate this example_

Download the Piper class of another friend (hypotetical class). Execute this command in your project folder:
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
This will print:
```bash
11.4
```

## Example 2: using custom function
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;

function uppercase( $input ) {
  return strtoupper( $input );
}

Piper::set('text')
  ->pipe('uppercase')
  ->echo();
```
This will print:
```bash
TEXT
```

## Example 3: mixing custom functions, PHP functions and Piper Comunity class
_this example features hyptotetical classes to illustrate this example_

Download the Piper class of another friend (hypotetical class). Execute this command in your project folder:
```bash
composer require someone/piper-array-average && composer update
```
Now let the fun begin:
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

## Example 4: without initial `set` method
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;

Piper::pipe( function() { return 'test' } )
  ->pipe('strtoupper')
  ->echo();
```
This will print:
```
TEST
```

## Example 5: using `get` instead of `echo`
```php
require __DIR__ . '/vendor/autoload.php';

$uppercase = Piper::set('test')
  ->pipe( 'strtoupper' )
  ->get();

echo $uppercase;
```
This will print:
```bash
TEST
```
## Example 6: using `Piper::input()` outside a pipeline
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;

function addOne() {
  return Piper::input() + 1; // Possible via static property (works like a Javascript's Promise)
}

Piper::set(2)
  ->pipe('addOne')
  ->echo();
```
This will print:
```bash
3
```
## Example 7: inserting "utilities" inside a pipe logic
```php
require __DIR__ . '/vendor/autoload.php';

use Khalyomede\Piper;

Piper::set('TEST')
  ->pipe('strtolower') // all lowercase
  ->echo()
  ->pipe('ucfirst') // only first character uppercase
  ->echo()
  ->eol()
  ->echo()
  ->print_r();
```
This will print:
```bash
testTest
Test
Test
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

### Guidelines for Piper Comunity class
We will give you some tips to do the cleanest Piper Comunity class possible:
#### 1 Use Piper before your package name
If you deal with array average, instead of `me/array-average` instead use `me/piper-array-average`. This will improve your SEO and help the comunity to see which composer package deals with Piper.
#### 2. Add "-php" in at the end of your package name
You might want to be clear that this github package (and soon this Packagist library) will be available only for PHP developpers so you might want to write `me/piper-array-average-php` to clearly set the goal of this project.
#### 3. Use kebab case for package name
Instead of naming your package `me/piperArrayAveragePHP`, prefer using `me/piper-array-average-php` for a better readability.
#### 4. Use an uppercase and camel case for your class name and file name
A good class name begins with an uppercase letter, and no dashes. An example of good class name would be:
```php
class PiperArrayAverage {}
```
#### 5. Use camel case for you class file
If we assume you put your class in folder `src/`, prefer using `src/piperArrayAverage.php` instead of `src/piperarrayaverage.php`. This will improves the readability.
#### 6. Precise you are dealing with PHP in your package description
Let the users know, since this description might be visible from Google search results.
#### 7. Use PHP pre-requisit >= 5.3.0
Set up your `composer.json` `require` attribute to at least `5.3.0` as the classes will use namespaces. For example, you `composer.json` could looks like this:
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
#### 8. Name your example file `getting-started.php`
This will let the user instantly know that it can rely on this file to learn more on the usage of your class.
#### 9. Prefer example instead of long descriptive method text
Users want to get quicly started and, mostly on the web, will cease to read if the description gets too long or too broad. Prefer short and explicit example than short descriptives text.
## Example step-by-step of how to build a Piper Comunity class
First, let us create a folder whenever you need. Let us name it "piper-add" :
```bash
mkdir piper-add
```
We will enter into this folder :
```bash
cd piper-add
```
Next thing, we will initiate Git repository :
```bash
git init
```
It is more convenient to do a Git init before a Composer init as Composer will then propose us to exclude `vendor` folder from every of your git push.

So naturally, the next thing you will want to do a initiate Composer :
```bash
composer init
```
Once you filled all the question in the prompt command, Composer will build a `composer.json` file.

Now, we will create the folder `src` that will contains `piperAdd.php` file, your next big community project...

Once you finished this last step, create another folder that will let us try our code. Create a `test` folder with a `test-pipe.php` file.

You will need to notify Composer that those files exists. To do so, update the `composer.json` file at the root of your folder, and add the following lines :
```json
...
"require": {
	"php": ">=5.3.0"	
},
...
"autoload": {
	"psr-4": {
		"You\\": "src/"
	}
}
```
So your final `composer.json` file should look like this :
```json
{
    "name": "you/piper-add",
    "description": "Piper Comunity class that let you chain addition on your workflow.",
    "type": "library",
    "license": "MIT",
    "minimum-stability": "stable",
    "require": {
    	"php": ">=5.3.0"
    },
    "autoload": {
    	"psr-4": {
    		"You\\": "src/"
    	}
    }
}
```
*IMPORTANT* Your `minimum-stability` should be set to `stable` to use this library. We will make an effort trying to figure out which composition of requirement is the best for you and us but for the moment if you would like to work with Piper you will need to set it to `stable`.

Now, in your project folder, use the command line again and type :
```bash
composer update
```
A new folder should have been created : `vendor`. Besides this folder, another file should also have been created : `composer.lock`, but do not mind (and do not update it).

It is time to begin the fun : writing your logic. Go to your file `src/piperAdd.php`, put PHP opening tags `<?php`, and add :
```php
namespace You;
```
This line will let the users import your class in their own project. This is why the autoloader needs this line (according to the name you set in `composer.json` at the `autoload` attribute).

Then add your class (empty) :
```php
class PiperAdd {
	
}
```
On thing to know is, to works correctly, Piper needs you to implement the `PiperContract` class. An interface is like a contract that you pass between us (Me and Aminnairi, creators of the library) and you. We will not give you a salary (unfortunately), but it is more like a moral contract : you agree that your class you are going to build should an must include 2 important methods : `public static function go( $parameter ) {}` and `public static function execute( $input ) {}`. 

`do` method is called when one of our friend use your class to pipe its logic. For example :
```php
use Khalyomede\Piper;
use You\PiperAdd as Add;

Piper::set(1)
	->pipe( Add::do(3) )
	->echo();
// echo "4"
```
But contrary as you could think, `do` does not handle the logic ! It must indeed only returns an instance of your class. We need it to make Piper works well, please trust us ;).

So, you will see a large majority of Piper Comunity class will have barely the same code :
```php
class PiperAdd {
  public static $parameter = 0;

  public static function do( $parameter ) {
    self::$parameter = $parameter;

    return new self;	
  }
}
```
Then, your logic will be located inside `execute` method. This is where you can have fun :
```php
class PiperAdd {
  public static $parameter = 0;

  public static function execute( $input ) {
    return self::$parameter + $input; // The addition is here
  }

  public static function do( $parameter ) {
    self::$parameter = $parameter;

    return new self;
  }
}
```
Like you can see, you will need to trust us again, and assume `$input` parameter of the method `execute` will be our `Piper::input()`, in other terms, will be the input of the last `::set()` or `::pipe()`. This two methods ensure the piping logic. 

Of course, you can tweak this base class to add as many other methods as you like, but this two methods should be still present to works correctly. If it is not the case, `PiperContract` will throw errors.

Hey, but where is this dear PiperContract ?? Dang ! Let fix it :
```php
use Khalyomede\PiperContract;

class PiperAdd {
  public static $parameter = 0;

  public static function execute( $input ) {
    return self::$parameter + $input; // The addition is here
  }

  public static function do( $parameter ) {
    self::$parameter = $parameter;

    return new self;
  }
}
```
This is better. But now, as you require a dependency, you need to import it via Packagist.org. Use your command line in your project folder, and do :
```bash
composer require khalyomede/piper-contract-php
```
The full result for the `src/piper-add.php` file should look like this :
```php
namespace You;

use Khalyomede\PiperContract;

class PiperAdd {
  public static $parameter = 0;

  public static function execute( $input ) {
    return self::$parameter + $input; // The addition is here
  }

  public static function do( $parameter ) {
    self::$parameter = $parameter;

    return new self;
  }
}
```
It is now time to try our class. To do so, create a file `test/test-pipe.php` containing :
```php
require __DIR__ '/../vendor/autoload.php';

use Khalyomede\Piper;
use You\PiperAdd;

Piper::set(1)
  ->pipe( Add::do(2) )
  ->echo();
```
If you test this file, the Composer autoloader will tell you that it does not know `Khalyomede\Piper`. To fix it, you need to import it from Packagist.org using :
```
composer require Khalyomede\Piper --dev
```
Noticed the `--dev` ? It is because your developer friend will already use Piper as a dependencies, so you do not want to overload your library with useless dependencies (not that Piper is useless, but you know a little in production for a custom library... Oh my god what I have said... Bare with me I slept 3 hours today).

Now you should be up and runing for your first test. Let us try it out. In your folder, open a command line if you did not and type :
```bash
php test/test-pipe.php
```
You should see in output :
```
3
```
You see this result because you make an addition of the set variable (1) and your Pipe Comunity class `Add` that add the parameter (2) to the input (1).

If you see any issue or something not running correctly as mentionned in this tutorial, please fill up an Issue and we will try our best to resolve it.

Congratulations. Have fun with it, we hope we can build together a better PHP developpement network that make us be more efficient with this pipe-oriented approach and avoid us re-programming similar logic !
## Need an example without parameters ?
Check [`Piper Array Average`](https://github.com/khalyomede/piper-array-average-php) Comunity class (PHP) and dive into the code to know how to quickly remove the needs of a parameter.
## Need an example with shared properties ?
PiperPHP seems to make shared variables like the one you share in a PDO logic complicated ? Not at all ! Using simple globals variable logic you can build powerful single-connection PDO logic (or any other object than PDO). With the use of defined conventions for naming your global Piper make this a breeze (for the end developper). Check [`Piper Pdo`](https://github.com/khalyomede/piper-pdo-php) to learn how to build this kind of advanced comunity class.
## Need more ?
Feel free to do a Pull Request and let us know which feature you would like to see the most.
