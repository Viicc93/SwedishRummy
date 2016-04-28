<?php
class Card {
  public $_cardId;
  public $_value;
  public $_suit;
  public $_href;
  function __construct($cardId, $value, $suit, $href){
    $this->_cardId = $cardId;
    $this->_value = $value;
    $this->_suit = $suit;
    $this->_href = $href;
  }
  public function getCardId()
  {
    return $this->_cardId;
  }
  public function getCardValue()
  {
    return $this->_value;
  }
  public function getCardSuit()
  {
    return $this->_suit;
  }
  public function getCardHref()
  {
    return $this->_href;
  }
  public function setBackCard($url)
  {
    $this->_href = $url;
    return $this->_href;
  }
}
