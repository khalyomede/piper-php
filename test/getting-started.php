<?php

require __DIR__ . '/../vendor/autoload.php';

use Khalyomede\Piper;
use Khalyomede\Add;

function uppercase( $text ) {
	return ucfirst($text);
}

echo Piper::set( 'TEST' )
	->pipe( 'strtolower' )
	->pipe( function() { return Piper::input()[0] . 'blabla'; } )
	->pipe('uppercase')
	->get();



echo php_sapi_name() === 'cli' ? PHP_EOL : '<br />';

// Can be used without initial set
echo Piper::pipe( function() { return 'TEST'; } )
	->pipe('strtolower')
	->pipe( function() { return Piper::input()[0] . 'blabla'; } )
	->pipe('uppercase')
	->get();