<?php 
	require_once '../json_manager.php';
	
	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['score']) && isset($_GET['value'])){
		echo addUserScore($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['score'], $_GET['value']);
	}
//addUserScore($username, $UUID, $game, $score, $value)
	//add_entry_to_score.php?username=justbake&UUID=59f5c077-2b45-4de3-85a3-072cb3823f00&game=bounce&score=highscore&value=10000
 ?>