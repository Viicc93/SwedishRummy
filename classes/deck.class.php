<?php
class Deck {
  /**
   * Card array
   *
   * @var array
   */

	private $_cards;
  private $cardsOnTable;
  private $backOfCard;
  private $_users;
  /**
   * The constructor define $_cards array.
   *
   *
   */

  public function __construct()
  {
    $this->_cards = [];
    $this->cardsOnTable = [];
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

  public function moveCardFromDeck($indexOfCard){
    array_splice($this->_cards, $indexOfCard, 1);
  }

  public function renderDeck($backOfCard){
    return $this->backOfCard = $backOfCard;
  }

}
