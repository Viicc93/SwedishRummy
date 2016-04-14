<?php
class Card {
	public $cardId;
	public $value;
	public $suit;
  public $imgUrl;

	function __construct($cardId, $value, $suit, $imgUrl){
		$this->cardId = $cardId;
		$this->value = $value;
		$this->suit = $suit;
    $this->imgUrl = $imgUrl;
	}
}

 ?>
