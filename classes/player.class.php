<?php

class Player {
	public $name;
	public $id;
	public $playerId;
	public $cardsOnHand;
	public $playCard;
	public $cardDraw;

	function __construct($name) {
		$this->cardsOnHand = [];
	//	global $GameFunction;
		// Säger till Player klassen att använda $GameFunction som skapades utanför klassen.
		// $GameFunction skapades i turn.class.php

	$this->name = $name;
	//	$GameFunction->addPlayer($name);
		// Lägger till Spelaren i GameFunction klassens array som håller reda på alla spelare.

	//	$this->id = $GameFunction->players();
		// Ger spelare id beroende på array längend i GameFunction klassen.
	}

	function getId() {
		return $this->id . "\n" . $this->name . "\n";
	}

	function dealCard($cardDraw) {
	//	$cards = ['hearts', 'diamonds', 'clubs', 'spades']; //Tillfäligt, drar kort från högen
	// $cardDraw = $cards[mt_rand(0, count($cards) - 1)];
		array_push($this->cardsOnHand, $cardDraw);
	}

	function cardCount() {
		foreach ($this->cardsOnHand as &$cardOnHand) {
			echo $cardOnHand . "\n";
		}
	}

}

 ?>