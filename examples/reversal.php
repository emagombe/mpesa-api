<?php

require __DIR__."/../autoload.php";

use emagombe\Mpesa;

set_time_limit(0);

$api_key = "";
$public_key = "";
$ssl = true;
$mpesa = Mpesa::init($api_key, $public_key, $ssl);

/* Reversal */
$data = [
	"value" => 10,
	"security_credential" => "",				#Required
	"indicator_identifier" => "",				#Required
	"transaction_id" => "",
	"agent_id" => 171717,
];
$mpesa->reversal($data, function($response) {
	print_r($response);
});