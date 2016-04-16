<?php

class Player {
	public $name;
	public $id;
<<<<<<< HEAD
	// public $playerId;
	public $cardsOnHand = [];
=======
	public $playerId;
	public $cardsOnHand;
>>>>>>> victoria
	public $playCard;
	public $cardDraw;

	function __construct($name) {
<<<<<<< HEAD
		$this->name = $name;

=======
		$this->cardsOnHand = [];
	//	global $GameFunction;
		// Säger till Player klassen att använda $GameFunction som skapades utanför klassen.
		// $GameFunction skapades i turn.class.php

	$this->name = $name;
	//	$GameFunction->addPlayer($name);
		// Lägger till Spelaren i GameFunction klassens array som håller reda på alla spelare.

	//	$this->id = $GameFunction->players();
		// Ger spelare id beroende på array längend i GameFunction klassen.
>>>>>>> victoria
	}

	function getId() {
		return $this->id . "\n" . $this->name . "\n";
	}

<<<<<<< HEAD
	function dealCard() {
		$cards    = ['hearts', 'diamonds', 'clubs', 'spades'];//Tillfäligt, drar kort från högen
		$cardDraw = $cards[mt_rand(0, count($cards)-1)];
=======
	function dealCard($cardDraw) {
	//	$cards = ['hearts', 'diamonds', 'clubs', 'spades']; //Tillfäligt, drar kort från högen
	// $cardDraw = $cards[mt_rand(0, count($cards) - 1)];
>>>>>>> victoria
		array_push($this->cardsOnHand, $cardDraw);
	}

	function cardCount() {
		foreach ($this->cardsOnHand as &$cardOnHand) {
			echo $cardOnHand . "\n";
		}
	}

}

?>
