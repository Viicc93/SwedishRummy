<?php
class Deck {
  /**
   * Card array
   *
   * @var array
   */

	private $_cards;
  private $_cardsOnTable;
  private $_backOfCard;
  private $_users;
  private $_card;
  /**
   * The constructor define $_cards array.
   *
   *
   */

  public function __construct()
  {
    $this->_cards = [];
    $this->_cardsOnTable = [];
    $this->_users = [];
  }

  ########################################################################
  # PUBLIC METHODS                                                       #
  ########################################################################

  /**
   * Manipulate $_cards array with card object.
   * This method uses composition to manipulate
   * $_cards array with all card objects.
   *
   *  @param object  Card  A card object
   */

  public function setCards(Card $card)
  {
    $this->_card = $card;
    // push card object to $_cards array
    array_push($this->_cards, $card);
  }


  public function getCards()
  {
    return $this->_cards;
  }

  public function addPlayers(User $user, Bot $bot){
    array_push($this->_users, $user, $bot);
  }

  public function moveCardFromDeck($cardIndex){
    array_splice($this->_cards, $cardIndex, 1);
  }

  public function renderDeck($_backOfCard){
    return $this->_backOfCard = $_backOfCard;
  }

  public function getCardOnTable()
  {
    for ($i=0; $i < count($this->_cards); $i++) {
      array_push($this->_cardsOnTable, $this->_cards[$i]);
    }
    return $this->_cardsOnTable;
  }
}
