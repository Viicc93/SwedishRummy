<?php
class Card {
	protected $_cardId;
	protected $_value;
	protected $_suit;
  protected $_href;

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
}
