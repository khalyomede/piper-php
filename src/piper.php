<?php

namespace Khalyomede;

use Khalyomede\PiperContract;
use Exception;

class Piper {
	public static $input = null;

	public static function set( $input ) {
		self::$input = $input;

		return new self;
	}

	public static function input() {
		return self::$input;
	}

	public static function pipe( $instance ) {
		if(	is_string($instance) ) {
			self::$input = call_user_func($instance, self::$input);
		}
		else if( is_callable($instance) ) {
			self::$input = $instance();
		}		

		else if( $instance instanceof PiperContract ) {
			self::$input = $instance::execute( self::$input );
		}
		else {
			throw new Exception('Mario broke the pipe...');
		}

		return new self;
	}

	public static function get() {
		return self::$input;
	}
}