<?php 
	require_once '../json_manager.php';
	
	if(isset($_GET['game']) && isset($_GET['score'])){
		echo getScores($_GET['game'], $_GET['score']);
	}
//http://localhost/Ouroboros/php/game/get_scores.php?game=bounce&score=highscore&username=justbake&UUID=59f5c077-2b45-4de3-85a3-072cb3823f00
 ?>
