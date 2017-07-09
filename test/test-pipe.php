<?php

require __DIR__ . '/../vendor/autoload.php';

use Khalyomede\Piper;

function addOne( $input ) {
	return $input + 1;
}

Piper::set(13)
  ->pipe( 'intval' )
  ->pipe( 'addOne' ) // your previously created function
  ->pipe( function() { return Piper::input() + 3; } )
  ->print_r();