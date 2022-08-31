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
$dbserver	= '10.135.16.54';
$dbuser		= 'Ahmoo';
$dbpass		= '?&1Q%R>y[lHp,W6KABZy?%l)v#_^';
$db			= 'infoscreen';
$q = $_REQUEST["q"];
$data = "";

$database = new Database($db, $dbuser, $dbpass, $dbserver);
$bpmCrud = new Crud($database, 'bpm');

if ($q !== "") {
	$q = strtolower($q);
	if ($q == "bpm") {
		$data = $bpmCrud->Read(['*']);
	} else {
		$data = "No result";
	}
}

print_r($data);