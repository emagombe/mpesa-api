<?php

namespace emagombe;

use emagombe\Mpesa;
use emagombe\Cryptor;

class Request {

	public $api_key = null;
	public $public_key = null;

	public function __construct() {
		$this->api_key = Mpesa::$api_key;
		$this->public_key = Mpesa::$public_key;
	}

	public function get($url_path, $params) {

		$query = http_build_query($params);

		$header = $this->prepare_headers([
			"Content-Type" => "application/json",
			"Origin" => "*",
			"Authorization" => "Bearer ".Cryptor::token($this->public_key, $this->api_key),
		]);

		$opts = array("http" =>
		    array(
		        "method"  => "GET",
		        "header"  => $header,
		        "ignore_errors" => true,
		        "protocol_version" => "1.1",
		        "request_fulluri" => false,
		    ),
		);
		$context  = stream_context_create($opts);
		$response = file_get_contents($url_path."?".$query, false, $context);
		return $response;
	}
	public function post($url_path, $params) {
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
		return $response;
	}

	public function put($url_path, $params) {
		$length = strlen($params);
		$header = $this->prepare_headers([
			"Content-Length" => $length,
			"Content-Type" => "application/json",
			"Origin" => "*",
			"Authorization" => "Bearer ".Cryptor::token($this->public_key, $this->api_key),
		]);

		$opts = array("http" =>
		    array(
		        "method"  => "PUT",
		        "header"  => $header,
		        "content" => $params,
		        "ignore_errors" => true,
		        "protocol_version" => "1.1",
		        "request_fulluri" => false,
		    )
		);
		$context  = stream_context_create($opts);
		$response = file_get_contents($url_path, false, $context);
		return $response;
	}

	private function prepare_headers($headers) {
 		return implode('', array_map(function($key, $value) {
 			return "$key: $value\r\n";
 		}, array_keys($headers), array_values($headers)));
 	}
}