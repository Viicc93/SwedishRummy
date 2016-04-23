<?php
class User extends Player {

	function __construct($name){
		Parent::__construct($name);

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
}
