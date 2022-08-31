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

$alertStatus = 'alert-secondary';

?>

<div id="beds">
	<div class="row">
		<?php
		$count = 0;
		foreach ($beds as $bed) {
			$alertStatus = match (true) {
				$bed['bpm'] <= 40 => 'alert-danger',
				$bed['bpm'] <= 50 => 'alert-warning',
				$bed['bpm'] <= 130 => 'alert-success',
				default => 'alert-danger',
			};

			?>
			<div class="column col-3 bed alert <?php echo $alertStatus ?>">
				<p class="fw-bold fs-3"><?php echo $bed['bed'] ?></p>
				<p><?php echo $bed['bpm'] ?></p>
			</div>
			<?php
		}
		?>
	</div>
</div>
