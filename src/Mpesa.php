<?php

namespace emagombe;

use emagombe\Transaction;

class Mpesa {

	public static $api_key = null;
	public static $public_key = null;
	public static $ssl = true;

	public function init($api_key, $public_key, $ssl = true) {
		self::$api_key = $api_key;
		self::$public_key = $public_key;
		self::$ssl = $ssl;
		return new Transaction();
	}
}