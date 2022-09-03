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
$alertAnimation = 'patient-danger';

?>
<div id="container" class="container">
	<?php
	// Counter for making rows.
	$count = 0;
	foreach ($beds as $bed) {

		if ($count == 0) {
			echo '<div class="row">';
			}

		if ($bed['bpm'] <= 40) {
			$alertStatus	= 'alert-danger';
			$alertAnimation	= 'patient-danger';
		} else if ($bed['bpm'] <= 50) {
			$alertStatus	= 'alert-warning';
			$alertAnimation	= 'patient-warning';
		} else if ($bed['bpm'] <= 130) {
			$alertStatus	= 'alert-success';
			$alertAnimation	= 'patient-okay';
		} else {
			$alertAnimation	= 'patient-danger';
		}

		?>	<div class="bed alert <?php echo "$alertStatus $alertAnimation" ?>">
			<p class="fw-bold fs-5 text-center"><?php echo str_replace('_', ' ', $bed['bed']) ?></p>
			<p class="bpm">BPM: <span class="fs-4"><?php echo $bed['bpm'] ?></span></p>
			<?php
			// Show a bell when nurse is called
			if ($bed['call'] == 1) {
				echo '<i class="bell bi bi-bell-fill"></i>';
			}

			// Show a warning icon when bad pulses are reached.
			if ($bed['bpm'] <= 50 || $bed['bpm'] > 130) {
				echo '<i class="warning-icon bi bi-exclamation-circle-fill"></i>';
			}

			// Play warning audio
			if ($bed['bpm'] <= 50) {
				?>
				<audio autoplay>
					<source src="audio/warning.mp3" type="audio/mpeg">
					Your browser isn't invited for super fun audio time.
				</audio>
				<?php
			}

			// Play danger audio
			if ($bed['bpm'] <= 50) {
				?>
				<audio autoplay>
					<source src="audio/danger.mp3" type="audio/mpeg">
					Your browser isn't invited for super fun audio time.
				</audio>
				<?php
			}
			?>
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
