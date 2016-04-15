<?php
class Player {
	public $name;
	public $id;
	// public $playerId;
	public $cardsOnHand = [];
	public $playCard;
	public $cardDraw;

	function __construct($name) {
		$this->name = $name;

	}

	function getId() {
		return $this->id;
	}

	function dealCard() {
		$cards    = ['hearts', 'diamonds', 'clubs', 'spades'];//Tillfäligt, drar kort från högen
		$cardDraw = $cards[mt_rand(0, count($cards)-1)];
		array_push($this->cardsOnHand, $cardDraw);
	}

	function cardCount() {
		foreach ($this->cardsOnHand as &$cardOnHand) {
			echo $cardOnHand;
		}
	}

}

?>
