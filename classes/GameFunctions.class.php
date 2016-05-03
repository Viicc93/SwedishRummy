<?php
class GameFunctions {
	public $playerCount = array();
	function addPlayer($name) {
		array_push($this->playerCount, $name);
	}
	function players() {
		return count($this->playerCount);
	}
}
