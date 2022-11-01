<?php

namespace emagombe;

use emagombe\Request;
use emagombe\Cryptor;

class Transaction {

	public function c2b($data, $callback) {
		$url = "https://api.sandbox.vm.co.mz:18352/ipg/v1x/c2bPayment/singleStage/";

		$params = [
			"input_TransactionReference" => isset($data["transaction_reference"]) ? $data["transaction_reference"] : uniqid(),
			"input_CustomerMSISDN" => $data["client_number"],
			"input_Amount" => $data["value"],
			"input_ThirdPartyReference" => (isset($data["transaction_id"]) ? $data["transaction_id"] : Cryptor::getId()),
			"input_ServiceProviderCode" => $data["agent_id"],
		];
		$params = json_encode($params);
		$request = new Request();
		$request->post($url, $params, function($response) use ($callback) {
			$callback($response);
		});
	}

	public function b2c($data, $callback) {
		$url = "https://api.sandbox.vm.co.mz:18345/ipg/v1x/b2cPayment/";
		$params = [
			"input_TransactionReference" => isset($data["transaction_reference"]) ? $data["transaction_reference"] : uniqid(),
			"input_CustomerMSISDN" => $data["client_number"],
			"input_Amount" => $data["value"],
			"input_ThirdPartyReference" => (isset($data["transaction_id"]) ? $data["transaction_id"] : Cryptor::getId()),
			"input_ServiceProviderCode" => $data["agent_id"],
		];
		$params = json_encode($params);
		$request = new Request();
		$request->post($url, $params, function($response) use ($callback) {
			$callback($response);
		});
	}

	public function b2b($data, $callback) {
		$url = "https://api.sandbox.vm.co.mz:18349/ipg/v1x/b2bPayment/";
		$params = [
			"input_TransactionReference" => isset($data["transaction_reference"]) ? $data["transaction_reference"] : uniqid(),
			"input_ReceiverPartyCode" => $data["agent_receiver_id"],
			"input_Amount" => $data["value"],
			"input_ThirdPartyReference" => (isset($data["transaction_id"]) ? $data["transaction_id"] : Cryptor::getId()),
			"input_PrimaryPartyCode" => $data["agent_id"],
		];
		$params = json_encode($params);
		$request = new Request();
		$request->post($url, $params, function($response) use ($callback) {
			$callback($response);
		});
	}

	public function reversal($data, $callback) {
		$url = "https://api.sandbox.vm.co.mz:18354/ipg/v1x/reversal/";
		$params = [
			"input_TransactionID" => $data["transaction_id"],
			"input_SecurityCredential" => $data["security_credential"],
			"input_InitiatorIdentifier" => $data["indicator_identifier"],
			"input_ThirdPartyReference" => isset($data["transaction_reference"]) ? $data["transaction_reference"] : uniqid(),
			"input_ServiceProviderCode" => $data["agent_id"],
			"input_ReversalAmount" => $data["value"],
		];
		$params = json_encode($params);
		$request = new Request();
		$request->put($url, $params, function($response) use ($callback) {
			$callback($response);
		});
	}
}