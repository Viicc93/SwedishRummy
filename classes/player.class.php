<?php

class Player {
	public $name;
	public $id;
	public $playerId;
	public $cardsOnHand = [];
	public $playCard;
	public $cardDraw;
	
	function __construct($name) {
		global $GameFunction;
		$this->name = $name;
		$GameFunction->playerCount($name);
		$this->id = $GameFunction->players();
	}

	function getId() {
		return $this->id;
	}
	
	function drawCard() {
		$cards = ['hearts', 'diamonds', 'clubs', 'spades']; //Tillfäligt, drar kort från högen
		$cardDraw = $cards[mt_rand(0, count($cards) - 1)];
		array_push($this->cardsOnHand, $cardDraw);
	}
	
	function cardCount() {
		foreach ($this->cardsOnHand as &$cardOnHand) {
			echo $cardOnHand;
		}
	}
	
}

$player1 = new Player("Thomas");
$player2 = new Player("efkhwehrkf");

echo $player2->getId();
$player1->drawcard();
$player1->drawcard();
$player1->drawcard();
$player1->cardCount();

 ?>