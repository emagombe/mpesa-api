<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);

/* Status */
$data = [
	"transaction_id" => "",
	"agent_id" => 171717,
	"third_party_reference" => 33333,
];
$mpesa->status($data, function($response) {
	print_r($response);
});