<?php

require __DIR__ . '/../vendor/autoload.php';

use Khalyomede\Piper;
use Khalyomede\Add;

echo Piper::set( 'TEST' )
	->pipe( 'strtolower' )
	->pipe( function() { return Piper::input()[0] . 'blabla'; } )
	->get();