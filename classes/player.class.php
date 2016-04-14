<?php
class Player {
	public $name;
	public $id;
	public $playerId;
	public $cardOnHand;
	public $playCard;
	
	function __construct($name) {
		$this->name = $name;
		
	}

	function getId() {
		return $this->id;
	}
	
	function drawCard() {
		$cards = ['hearts', 'diamonds', 'clubs', 'spades']; //Tillfäligt, drar kort från högen
		$cardDraw = $cards[mt_rand(0, count($cards) - 1)];
		return $cardDraw;
	}
	
}

$player1 = new Player("Thomas");
echo $player1->drawcard();

 ?>