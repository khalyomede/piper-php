<?php

namespace Khalyomede;

use Khalyomede\PiperContract;

class Add implements PiperContract {
	public static $parameter = 0;

	public static function execute( $input ) {
		return self::$parameter + $input;
	}

	public static function do( $parameter ) {
		self::$parameter = $parameter;

		return new self;
	}
}