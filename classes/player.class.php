<?php

class Player {
	public $name;
	protected $_id;
	protected $_playerId;
	protected $_cardsOnHand;
	public $playCard;
	public $cardDraw;

	function __construct($name) {
		$this->_cardsOnHand = [];
		$this->_id = rand(1, 8);
		$this->_playerId = $this->_id;
	//	global $GameFunction;
		// Säger till Player klassen att använda $GameFunction som skapades utanför klassen.
		// $GameFunction skapades i turn.class.php

	$this->name = $name;
	//	$GameFunction->addPlayer($name);
		// Lägger till Spelaren i GameFunction klassens array som håller reda på alla spelare.

	//	$this->id = $GameFunction->players();
		// Ger spelare id beroende på array längend i GameFunction klassen.
	}

	public function dealCard($cardObj) {
	//	$cards = ['hearts', 'diamonds', 'clubs', 'spades']; //Tillfäligt, drar kort från högen
	// $cardObj = $cards[mt_rand(0, count($cards) - 1)];
		array_push($this->_cardsOnHand, $cardObj);
	}

	public function cardCount() {
		foreach ($this->_cardsOnHand as $cardOnHand) {
			print_r($_cardOnHand) . "\n";
		}
	}

	public function getCardsArray()
	{
		return $this->_cardsOnHand;
	}

}

 ?>
