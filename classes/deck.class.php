<?php
class Deck {

	public $cardDeck;

	function __construct($cardArray){
		$this->cardDeck = [];
		for ( $i=0; $i < count($cardArray); $i++) {
			array_push($this->cardDeck, $card[$i]); // push card object to array to create a deck
		}

	}

}