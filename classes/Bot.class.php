<?php
class Bot extends Player {

	function __construct(){
		Parent::__construct("Anna");
	}

	// return one random card from Bot $_cardOnHand array
	public function PlayCard(){
		// get random index
		$randIndex = rand(0, 7);
			return array_splice($this->getBotCards(), $randIndex, 1);
	}
	public function DrawCard(){
		# code for player to draw a card when no match on hand....
	}
	public function RenderCard(){
		# code to render cards on hand...
	}
	public function getBotCards()
	{
		return $this->getCardsArray();
	}

	// return Bot object
	public function getBotObj()
	{
		return $this;
	}
}
