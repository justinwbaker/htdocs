<?php 
	require_once '../json_manager.php';
	
	if(isset($_GET['game']) && isset($_GET['score'])){
		echo addScore($_GET['game'], $_GET['score']);
	}

 ?>