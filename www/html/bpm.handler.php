<?php

/*
 * Servers:
 * - Skúlaheim
 *   - 192.168.80.2
 *   - 192.168.80.12
 *   - 192.168.80.17
 * - Hotspot
 *   - 192.168.95.115
 * - Heima
 *   - 192.168.1.222
 * - Skúli
 *   - 10.135.16.54
 */
 $server = '10.135.16.54';
//$server = '127.0.0.1';
$q = $_REQUEST["q"];

$data = "";

if ($q !== "") {
	$q = strtolower($q);
	if ($q == "bpm") {
		$ch = curl_init("http://$server:8080/bpm");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
	} else {
		$data = "No result";
	}
}

print_r($data);