<?php

namespace Khalyomede;

use Khalyomede\PiperContract;
use InvalidArgumentException;

class Piper {
	const INDENT = 1;
	const NOINDENT = 2;

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
			if(! function_exists($instance)) {
				throw new InvalidArgumentException((string) $instance . ' function does not exist');
			}

			self::$input = call_user_func($instance, self::$input);
		}
		else if( is_callable($instance) ) {
			self::$input = $instance();
		}		

		else if( $instance instanceof PiperContract ) {
			self::$input = $instance::execute( self::$input );
		}
		else {
			throw new InvalidArgumentException(get_class($instance) . ' does not implements PiperContract interface');
		}

		return new self;
	}

	public static function get() {
		return self::$input;
	}

	public static function echo() {
		echo self::$input;

		return new self;
	}

	public static function exec() {
		exec( self::$input );

		return new self;
	}

	public static function print_r( $mode = self::INDENT ) {
		if( php_sapi_name() !== 'cli' && $mode === self::INDENT ) {
			echo '<pre>';
		}

		print_r( self::$input );

		if( php_sapi_name() !== 'cli' && $mode === self::INDENT ) {
			echo '</pre>';
		}

		return new self;
	}
}