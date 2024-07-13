<?php

namespace emagombe;

use emagombe\Transaction;

class Mpesa {

	public static $api_key = null;
	public static $public_key = null;
	public static $environment = "development";

	public static function init($api_key, $public_key, $environment) {
		self::$api_key = $api_key;
		self::$public_key = $public_key;
		self::$environment = $environment;
		return new Transaction();
	}
}