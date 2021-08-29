<?php

namespace emagombe;

class Cryptor {

	public static function token($public_key, $api_key) {
		$public_key_decoded = base64_decode($public_key);
		$pem = self::der2pem($public_key_decoded);
		$new_key = openssl_get_publickey($pem);

		openssl_public_encrypt($api_key, $crypted, $new_key, OPENSSL_PKCS1_PADDING);
		return base64_encode($crypted);
	}

	/* Convert Pem to Der */
	public static function pem2der($pem_data) {
		$begin = "KEY-----";
		$end   = "-----END";
		$pem_data = substr($pem_data, strpos($pem_data, $begin) + strlen($begin));
		$pem_data = substr($pem_data, 0, strpos($pem_data, $end));
		$der = base64_decode($pem_data);
		return $der;
	}

	/* Convert Der to Pem */
	public static function der2pem($der_data) {
		$pem = chunk_split(base64_encode($der_data), 64, "\n");
		$pem = "-----BEGIN PUBLIC KEY-----\n".$pem."-----END PUBLIC KEY-----\n";
		return $pem;
	}

	public static function getId($length = 8) {
	    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}