<?php
class Deck {
	private $_cards;
  public function __construct()
  {
    $this->_cards = [];
  }

  public function setCards(Card $card)
  {
    array_push($this->_cards, $card);
  }
}
