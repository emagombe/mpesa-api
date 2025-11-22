<?php

namespace emagombe;

use emagombe\Request;
use emagombe\Cryptor;

class Transaction {

	public function c2b($data, $callback = null) {
		$is_production = Mpesa::$environment == "production";
		$base_url = $is_production ? "api.vm.co.mz" : "api.sandbox.vm.co.mz";
		$url = "https://$base_url:18352/ipg/v1x/c2bPayment/singleStage/";

		$params = [
			"input_Amount" => $data["value"],
			"input_CustomerMSISDN" => $data["client_number"],
			"input_ServiceProviderCode" => $data["agent_id"],
			"input_TransactionReference" => $data["transaction_reference"],
			"input_ThirdPartyReference" => $data["third_party_reference"],
		];
		$params = json_encode($params);
		$request = new Request();

		if($callback != null) {
			trigger_error('Uso de callback foi depreciado e será removido nas próximas versões. Considere usar o valor retornado pela função: $response = mpesa->c2b()', E_USER_DEPRECATED);
			$response = $request->post($url, $params);
			$callback($response);
		} else {
			return $request->post($url, $params);
		}
	}

	public function b2c($data, $callback = null) {
		$is_production = Mpesa::$environment == "production";
		$base_url = $is_production ? "api.vm.co.mz" : "api.sandbox.vm.co.mz";
		$url = "https://$base_url:18345/ipg/v1x/b2cPayment/";
		$params = [
			"input_Amount" => $data["value"],
			"input_CustomerMSISDN" => $data["client_number"],
			"input_ServiceProviderCode" => $data["agent_id"],
			"input_TransactionReference" => $data["transaction_reference"],
			"input_ThirdPartyReference" => $data["third_party_reference"],
		];
		$params = json_encode($params);
		$request = new Request();
		if($callback != null) {
			trigger_error('Uso de callback foi depreciado e será removido nas próximas versões. Considere usar o valor retornado pela função: $response = mpesa->b2c()', E_USER_DEPRECATED);
			$response = $request->post($url, $params);
			$callback($response);
		} else {
			return $request->post($url, $params);
		}
	}

	public function b2b($data, $callback = null) {
		$is_production = Mpesa::$environment == "production";
		$base_url = $is_production ? "api.vm.co.mz" : "api.sandbox.vm.co.mz";
		$url = "https://$base_url:18349/ipg/v1x/b2bPayment/";
		$params = [
			"input_TransactionReference" => $data["transaction_reference"],
			"input_PrimaryPartyCode" => $data["agent_id"],
			"input_ReceiverPartyCode" => $data["agent_receiver_id"],
			"input_Amount" => $data["value"],
			"input_ThirdPartyReference" => $data["third_party_reference"],
		];
		$params = json_encode($params);
		$request = new Request();
		if($callback != null) {
			trigger_error('Uso de callback foi depreciado e será removido nas próximas versões. Considere usar o valor retornado pela função: $response = mpesa->b2b()', E_USER_DEPRECATED);
			$response = $request->post($url, $params);
			$callback($response);
		} else {
			return $request->post($url, $params);
		}
	}

	public function reversal($data, $callback = null) {
		$is_production = Mpesa::$environment == "production";
		$base_url = $is_production ? "api.vm.co.mz" : "api.sandbox.vm.co.mz";
		$url = "https://$base_url:18354/ipg/v1x/reversal/";
		$params = [
			"input_TransactionID" => $data["transaction_id"],
			"input_SecurityCredential" => $data["security_credential"],
			"input_InitiatorIdentifier" => $data["indicator_identifier"],
			"input_ThirdPartyReference" => $data["third_party_reference"],
			"input_ServiceProviderCode" => $data["agent_id"],
			"input_ReversalAmount" => $data["value"],
		];
		$params = json_encode($params);
		$request = new Request();
		if($callback != null) {
			trigger_error('Uso de callback foi depreciado e será removido nas próximas versões. Considere usar o valor retornado pela função: $response = mpesa->reversal()', E_USER_DEPRECATED);
			$response = $request->put($url, $params);
			$callback($response);
		} else {
			return $request->put($url, $params);
		}
	}

	public function status($data, $callback = null) {
		$is_production = Mpesa::$environment == "production";
		$base_url = $is_production ? "api.vm.co.mz" : "api.sandbox.vm.co.mz";
		$url = "https://$base_url:18353/ipg/v1x/queryTransactionStatus/";
		$params = [
			"input_QueryReference" => $data["transaction_id"],
			"input_ThirdPartyReference" => $data["third_party_reference"],
			"input_ServiceProviderCode" => $data["agent_id"],
		];
		$request = new Request();
		if($callback != null) {
			trigger_error('Uso de callback foi depreciado e será removido nas próximas versões. Considere usar o valor retornado pela função: $response = mpesa->status()', E_USER_DEPRECATED);
			$response = $request->get($url, $params);
			$callback($response);
		} else {
			return $request->get($url, $params);
		}
	}

	public function customer_name($data, $callback = null) {
		$is_production = Mpesa::$environment == "production";
		$base_url = $is_production ? "api.vm.co.mz" : "api.sandbox.vm.co.mz";
		$url = "https://$base_url:19323/ipg/v1x/queryCustomerName/";
		$params = [
			"input_CustomerMSISDN" => $data["client_number"],
			"input_ThirdPartyReference" => $data["third_party_reference"],
			"input_ServiceProviderCode" => $data["agent_id"],
		];
		$request = new Request();
		if($callback != null) {
			trigger_error('Uso de callback foi depreciado e será removido nas próximas versões. Considere usar o valor retornado pela função: $response = mpesa->customer_name()', E_USER_DEPRECATED);
			$response = $request->get($url, $params);
			$callback($response);
		} else {
			return $request->get($url, $params);
		}
	}
}