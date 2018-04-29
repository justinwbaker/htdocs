<?php 
	require_once '../json_manager.php';
	
	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game'])){
		echo addGameToUser($_GET['username'], $_GET['UUID'], $_GET['game']);
	}
	//addGameToUser($username, $UUID, $game)
//http://localhost/Ouroboros/php/game/add_game_to_user.php?game=bounce&username=justbake&UUID=59f5c077-2b45-4de3-85a3-072cb3823f00
 ?>
