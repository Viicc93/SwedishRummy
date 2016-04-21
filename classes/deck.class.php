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
   * The constructor define $_cards array,
   *  _cardsOnTable and _users arrays.
   * It calls addBotPlayer() method to
   * instantiate Bot-class.
   */

  public function __construct()
  {
    $this->_cards = [];
    $this->_cardsOnTable = [];
    $this->_users = [];
    // add Bot player
    $this->addBotPlayer();
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
  /**
   * Adding players to the game.
   *
   * This method use composition to add the plyaer,
   * and then push them to _users array.
   * It is calling dealCardToPlayers() method also
   * to deal 8 cards to every user.
   *
   * @param object  require user object.
   */
  public function addPlayers(User $user){
    // push user object to _users array
    array_push($this->_users, $user);
    // call dealCardToPlayers method
    $this->dealCardToPlayers();
  }

  private function addBotPlayer()
  {
    array_push($this->_users, new Bot());
  }


  /*
  * Dealing 8 cards to every plyaer. This method
  * will be called from class's constructor when we
  * instantiate deck-object.
  * It loop through _users array and then suffle
  * _cards array 8 times and then pop an card-item and push it in
  * _cardsOnHand array that located in Player-class.
  */
  private function dealCardToPlayers(){
    // loop through _users array
    for ($i=0; $i < count($this->_users); $i++) {
      for ($j=0; $j < 8; $j++) {
        // shuffle _cards array
        shuffle($this->_cards);
        // pop a card-item and push it into _cardsOnHand array
        array_push( $this->_users[$i]->_cardsOnHand, array_pop($this->_cards));
      }
    }
   }
  }

  public function setUserId()
  {
    // for ($i=0; $i < count($this->_users); $i++) {
    //   echo $this->_users->$_playerId;
    // }
  }

  public function getUser()
  {
    return $this->_users;
  }


  // public function moveCardFromDeck($cardIndex){
  //   array_splice($this->_cards, $cardIndex, 1);
  // }

  public function renderDeck($_backOfCard){
    return $this->_backOfCard = $_backOfCard;
  }

  public function getCardOnTable()
  {
    for ($i=0; $i < count($this->_cards); $i++) {
      array_push($this->_cardsOnTable, $this->_cards[$i]);
    }
    shuffle($this->_cardsOnTable);
    return $this->_cardsOnTable;
  }
}
