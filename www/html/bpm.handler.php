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
		$data = file_get_contents("http://localhost:8080/bpm");
		$data = json_decode($data);
		$data = shell_exec('ping -c1 google.com');
	} else {
		$data = "No result";
	}
}

echo "<pre>";
print_r($data);
echo "</pre>";