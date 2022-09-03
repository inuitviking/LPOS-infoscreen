<?php

// Require necessary classes
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
$dbserver	= '192.168.1.222';
$dbuser		= 'Ahmoo';
$dbpass		= '?&1Q%R>y[lHp,W6KABZy?%l)v#_^';
$db			= 'infoscreen';

// Connect to database and the bpm table
$database = new Database($db, $dbuser, $dbpass, $dbserver);
$bpmCrud = new Crud($database, 'bpm');

// Read from the bpm table.
$beds = $bpmCrud->Read();

// Set the default alert status
$alertStatus = 'alert-danger';

?>
<div id="container"
	style="display: grid;
		grid-template-columns: auto;
		padding: 8px;">
	<?php
	// Counter for
	$count = 0;
	foreach ($beds as $bed) {

		if ($count == 0) {
			echo '<div class="row">';
			}

		$alertStatus = match (true) {
			$bed['bpm'] <= 40 => 'alert-danger',
			$bed['bpm'] <= 50 => 'alert-warning',
			$bed['bpm'] <= 130 => 'alert-success',
			default => 'alert-danger',
		};

		?>	<div class="alert <?php echo $alertStatus ?>"
		style="margin-left: 4.166px;
			margin-right: 4.166px;
			width: calc( 100% / 4 );;">
			<p class="fw-bold fs-5"><?php echo str_replace('_', ' ', $bed['bed']) ?></p>
			<p">BPM: <span class="fs-41"><?php echo $bed['bpm'] ?></span></p>
			<p>Call: <?php echo $bed['call']; ?></p>
		</div>
	<?php
		if ($count == 2) {
			echo '</div>';
			$count = 0;
		} else {
			$count++;
		}
	}
	?>
</div>
