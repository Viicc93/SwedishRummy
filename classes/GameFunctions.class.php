<?php
<<<<<<< HEAD:classes/turn.class.php
	class GameFunctions {
		public $playerCount = array();
		
		function addPlayer($name){
			array_push($this->playerCount, $name);
		}

		function players(){
			return count($this->playerCount);
		}
=======
class GameFunctions {

	public $playerCount = array();

	function addPlayer($name){
		array_push($this->playerCount, $name);
>>>>>>> mohamad:classes/GameFunctions.class.php
	}

	$GameFunction = new GameFunctions;
?>