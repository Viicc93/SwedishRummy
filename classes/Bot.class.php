<?php
class Bot extends Player {
	function __construct(){
		Parent::__construct("Anna");
	}
	public function PlayCard(){
		# code for player to play a card on hand...
	}
	public function DrawCard(){
		# code for player to draw a card when no match on hand....
	}
	public function RenderCard(){
		# code to render cards on hand...
	}
	public function getId() {
		return $this->_playerId;
	}
}
 ?>