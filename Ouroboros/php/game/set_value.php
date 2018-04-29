<?php 
	require_once '../json_manager.php';

	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['variable']) && isset($_GET['value'])){
		echo setValue($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['variable'], $_GET['value']);
	}
//http://localhost/Ouroboros/php/game/set_value.php?game=bounce&username=justbake&UUID=59f5c077-2b45-4de3-85a3-072cb3823f00&variable=total&value=5
 ?>