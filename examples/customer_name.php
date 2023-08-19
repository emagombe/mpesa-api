<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);

/* Customer name */
$data = [
	"client_number" => "258840000000",
	"agent_id" => 171717,
	"third_party_reference" => 33333,
];
$mpesa->customer_name($data, function($response) {
	print_r($response);
});