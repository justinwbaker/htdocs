<?php 
	require_once '../json_manager.php';
	
	if(isset($_GET['username']) && isset($_GET['UUID']) && isset($_GET['game']) && isset($_GET['score']) && isset($_GET['value'])){
		echo setScore($_GET['username'], $_GET['UUID'], $_GET['game'], $_GET['score'], $_GET['value']);
	}

 ?>