<?php

	require_once 'config.php';

	function createUser($username, $UUID, $name, $lastname, $age, $gender) {
		$file_path = "../../../users/template.json";
		$file = "../../../users/2018/" . $username . "-" . $UUID . ".json";
		
		$template = file_get_contents($file_path);
		if($template != false){
			$user = json_decode($template);

			$user->UUID = $UUID;
			$user->gamerTag = $username;
			$user->name = $name;
			$user->lastname = $lastname;
			$user->age = (int)$age;
			$user->gender = $gender;

			$fh = fopen($file, 'w') or die("can't open file");
			fwrite($fh, json_encode($user, JSON_PRETTY_PRINT));
			fclose($fh);
			return true;
		}else {
			return false;
		}
	}

	function getUser($username, $UUID) {
		$file = "../../../users/2018/" . $username . "-" . $UUID . ".json";
		$contents = file_get_contents($file);
		$user = json_decode($contents);

		return $user;
	}

	function addGameToUser($username, $UUID, $game) {
		$game_path = "../../../games/". $game.".json";
		$user_path = "../../../users/2018/" . $username . "-" . $UUID . ".json";

		$game_string = file_get_contents($game_path);
		$game_json = json_decode($game_string);

		$user_string = file_get_contents($user_path);
		$user = json_decode($user_string);

		$user_name = $username . "-" . $UUID;

		if(!isset($game_json->users->$user_name)){
			$game_json->users->$user_name = $game_json->variables;
		}else {
			echo "user already has Game";
		}

		if(!isset($user_json->games->$game)) {
			$user_json->games->$game = $game;
		}else {
			echo "user already has Game";
		}

		$fh = fopen($game_path, 'w') or die("can't open file");
		fwrite($fh, json_encode($game_json, JSON_PRETTY_PRINT));
		fclose($fh);

		$fh = fopen($user_path, 'w') or die("can't open file");
		fwrite($fh, json_encode($user_path, JSON_PRETTY_PRINT));
		fclose($fh);
	}

	function getValue($username, $UUID, $game, $variable) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string);

			if(!isset($game_json->users->$username)) {
				$return = "player has not played this game";
			}else{
				$return = $game_json->users->$username->$variable;
			}

		} else {
			$return = "game not found";
		}
		return $return;
	}

	function setValue($username, $UUID, $game, $variable, $value) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string);

			$user = $username . "-" . $UUID;

			if(!isset($game_json->users->$user)) {
				$return = "player has not played this game";
			}else{
				$game_json->users->$user->$variable = $value;

				$fh = fopen($game_path, 'w') or die("can't open file");
				fwrite($fh, json_encode($game_json, JSON_PRETTY_PRINT));
				fclose($fh);

				$return = "variable added to player";

				return $return;
			}

		} else {
			$return = "game not found";
		}
		return $return;
	}

	function addVariableToGame($game, $variable, $value) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string);

			$game_json->variables->$variable = $value;

			//loop through all users
			foreach ($game_json->users as $key) {
			 	$key->$variable = $value;
			}

			$fh = fopen($game_path, 'w') or die("can't open file");
			fwrite($fh, json_encode($game_json, JSON_PRETTY_PRINT));
			fclose($fh);

			$return = "variable added to player";

		} else {
			$return = "game not found";
		}
		return $return;

	}

	function setScore($username, $UUID, $game, $score, $value) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string, false);

			$user = $username . "-" . $UUID;

			if(isset($game_json->scores->$score)) {
				$game_json->scores->$score->$user = $value;

				$fh = fopen($game_path, 'w') or die("can't open file");
				fwrite($fh, json_encode($game_json, JSON_PRETTY_PRINT));
				fclose($fh);

				$return = "variable added to scores";
			}else {
				$return = $score . " does not exist in scores";
			}

		} else {
			$return = "game not found";
		}
		return $return;
	}

	function addScore($game, $score) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string, false);

			if(isset($game_json->scores->$score)) {

				$return = "variable already added to scores";
			}else {
				
				$game_json->scores->$score = (object)[];

				$fh = fopen($game_path, 'w') or die("can't open file");
				fwrite($fh, json_encode($game_json, JSON_PRETTY_PRINT));
				fclose($fh);

				$return = "variable added to scores";
			}

		} else {
			$return = "game not found";
		}
		return $return;
	}

	function addUserScore($username, $UUID, $game, $score, $value) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string, false);

			$user = $username . "-" . $UUID;

			$game_json->scores->$score->$user = $value;

			$fh = fopen($game_path, 'w') or die("can't open file");
			fwrite($fh, json_encode($game_json, JSON_PRETTY_PRINT));
			fclose($fh);

			$return = "variable added to scores";

		} else {
			$return = "game not found";
		}
		return $return;
	}

	function getScore($username, $UUID, $game, $score) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string, false);

			$user = $username . "-" . $UUID;

			$return = $game_json->scores->$score->$user;
		} else {
			$return = "game not found";
		}

		return $return;
	}

	function getScores($game, $score) {
		$game_path = "../../../games/". $game.".json";

		$return = "null";

		if(file_get_contents($game_path)) {
			$game_string = file_get_contents($game_path);
			$game_json = json_decode($game_string, false);

			$return = "";

			$fruitArrayObject = (Array) ($game_json->scores->$score);
			arsort($fruitArrayObject);

			foreach ($fruitArrayObject as $key => $val) {
			    $return .= "$key:$val\n";
			}

		} else {
			$return = "game not found";
		}


		return $return;
	}

?>