<?php

namespace emagombe;

use emagombe\Mpesa;
use emagombe\Cryptor;

class Request {

	public $api_key = null;
	public $public_key = null;
	public $ssl = true;

	public function __construct() {
		$this->api_key = Mpesa::$api_key;
		$this->public_key = Mpesa::$public_key;
		$this->ssl = Mpesa::$ssl;
	}

	public function get($url_path, $params, $callback) {
		$length = strlen(http_build_query($params));

		$header = $this->prepare_headers([
			"Content-Length" => $length,
			"Content-Type" => "application/json",
			"Origin" => "*",
			"Authorization" => "Bearer ".Cryptor::token($this->public_key, $this->api_key),
			"ignore_errors" => true,
	        "protocol_version" => "1.1",
	        "request_fulluri" => false,
		]);

		$opts = array("http" =>
		    array(
		        "method"  => "GET",
		        "header"  => $header,
		        "content" => http_build_query($params),
		        "ignore_errors" => false,
		    ),
		);
		$context  = stream_context_create($opts);
		$response = file_get_contents($url_path, false, $context);
		$callback($response);
	}
	public function post($url_path, $params, $callback) {
		$length = strlen($params);
		$header = $this->prepare_headers([
			"Content-Length" => $length,
			"Content-Type" => "application/json",
			"Origin" => "*",
			"Authorization" => "Bearer ".Cryptor::token($this->public_key, $this->api_key),
		]);

		$opts = array("http" =>
		    array(
		        "method"  => "POST",
		        "header"  => $header,
		        "content" => $params,
		        "ignore_errors" => true,
		        "protocol_version" => "1.1",
		        "request_fulluri" => false,
		    )
		);
		$context  = stream_context_create($opts);
		$response = file_get_contents($url_path, false, $context);
		$callback($response);
	}

	private function prepare_headers($headers) {
 		return implode('', array_map(function($key, $value) {
 			return "$key: $value\r\n";
 		}, array_keys($headers), array_values($headers)));
 	}
}