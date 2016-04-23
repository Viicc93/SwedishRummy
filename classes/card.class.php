<?php
class Card {
  public $cardId;
  public $value;
  public $suit;
  public $href;
  function __construct($cardId, $value, $suit, $href){
    $this->cardId = $cardId;
    $this->value = $value;
    $this->suit = $suit;
    $this->href = $href;
  }
  public function getCardId()
  {
    return $this->cardId;
  }
  public function getCardValue()
  {
    return $this->value;
  }
  public function getCardSuit()
  {
    return $this->suit;
  }
  public function getCardHref()
  {
    return $this->href;
  }
}
