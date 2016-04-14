<?php
class Card {
	public $cardId;
	public $value;
	public $suit;

	function __construct( $cardId, $value, $suit ){
		$this->cardId = $cardId;
		$this->value = $value;
		$this->suit = $suit;

	}
}

 ?>