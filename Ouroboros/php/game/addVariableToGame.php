<?php 
	require_once '../json_manager.php';
	
	if(isset($_GET['game']) && isset($_GET['variable']) && isset($_GET['value'])){
		echo addVariableToGame($_GET['game'], $_GET['variable'], $_GET['value']);
	}

 ?>