<?php

require_once 'classes/Database.php';
require_once 'classes/CRUD.php';

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

$database = new Database($db, $dbuser, $dbpass, $dbserver);
$bpmCrud = new Crud($database, 'bpm');
$beds = $bpmCrud->Read();

?>

<div id="beds">
	<?php
	foreach ($beds as $bed) {
		?>
		<div class="bed">
			<p><?php echo $bed['bed'] ?></p>
			<p><?php echo $bed['bpm'] ?></p>
		</div>
		<?php
	}
	?>
</div>
