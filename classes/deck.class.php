<?php
class Deck
{
  /**
   * Card array
   *
   * @var array
   */
    public $_cards;
 // public $_cardsOnTable;
    public $_backOfCard;
    public $_users;
    //public $_card;
    public $_usersId;
    public $_thrownCards;
    public $playerTurn;
    public $newSuit;
    public $winner;
    public $isEight;
    public $availableCards;

    public $drowCard;



  /**
   * The constructor define $_cards array,
   *  _cardsOnTable and _users arrays.
   * It calls addBotPlayer() method to
   * instantiate Bot-class.
   */
    public function __construct()
    {
        // Define cards array
        $this->_cards = [];


        // Define users array
        $this->_users = [];

        // Define thrown cards array
        $this->_thrownCards = [];

        $this->availableCards = [];

        // Define is eight property
        $this->isEight = false;

        // Define player turn property
        $this->playerTurn = 0;

        // Add Bot player
        $this->addBotPlayer();

        $this->drowCard = false;

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
    public function addPlayers(User $user)
    {
        if (count($this->_users) < 4) {
            // push user object to _users array
            array_push($this->_users, $user);
        }
        // call dealCardToPlayers method
        $this->dealCardToPlayers();
    }


/* ==========================================================================
   BOT Player
   ========================================================================== */

  /**
   * botPlayCard() is the method that will be called
   * when Bot turn
   *
   */
    public function botPlayCard()
    {
      // Check if $playerTurn property is set to 0
      if ($this->getPlayerTurn() == 0) {
        $latestCard = end($this->_thrownCards);

        // check if card's value is 8
        if ($latestCard->_value == 8) {

            // Set $playerTurn property to 0
            $this->playerTurn = 0;

            // Set isEight property to true
            $this->isEight = true;

        }


          // Set $playerTurn property to the next player
          $this->nextPlayer();

        // Loop through Bot hand
        for ($i=0; $i < count($this->_users[0]->_cardsOnHand); $i++) {

          // Check if there are cards that match the last thrown card
          if ($this->_users[0]->_cardsOnHand[$i]->getCardValue() == $this->getThrownCard()[0]->getCardValue() ||
              $this->_users[0]->_cardsOnHand[$i]->getCardSuit() == $this->getThrownCard()[0]->getCardSuit()) {

            // Push all match cards to $availableCards array
            array_push($this->availableCards, array_splice($this->_users[0]->_cardsOnHand, $i, 1)[0]);
          return $this->availableCards;
        }

      }
      // if (empty($this->availableCards)) {
      //   return 'empty';
      // }
      //     // Move the first object in $this->availableCards array to thrown cards array
      //     array_push($this->_thrownCards, array_splice($this->availableCards, 0, 1)[0]);


      //   for ($i=0; $i < count($this->availableCards); $i++) {

      //     array_push($this->_users[0]->_cardsOnHand, array_splice($this->availableCards, $i, 1)[0]);
      //   }

    }
  }



    public function addBotPlayer()
    {
        array_push($this->_users, new Bot());
    }

  /**
   * Get Bot player
   *
   *
   */
    public function getBotPlayer()
    {
        return $this->getUser()[0];
    }

/* ************************************************************************************************************************************** */



  /*
  * Dealing 8 cards to every plyaer. This method
  * will be called from class's constructor when we
  * instantiate deck-object.
  * It loop through _users array and then suffle
  * _cards array 8 times and then pop an card-item and push it in
  * _cardsOnHand array that located in Player-class.
  */
    public function dealCardToPlayers()
    {
        // shuffle _cards array
        shuffle($this->_cards);
        // loop through _users array
        for ($i=0; $i < count($this->_users); $i++) {
            for ($j=0; $j < 8; $j++) {
                if (count($this->_users[$i]->_cardsOnHand) < 8) {
                    // pop a card-item and push it into _cardsOnHand array
                    array_push($this->_users[$i]->_cardsOnHand, array_pop($this->_cards));
                }
            }
        }
    }

    public function showCardsOnHand()
    {

        for ($i=0; $i < count($this->_users); $i++) {
            $cards = $this->_users[$i]->getCardsArray();
        }
        return $cards;
    }

  /**
   * getUserId() method is a method that looping through
   * user objects, and by using getUserId() method which is
   * in user object, it will return the array _userId.
   */
    public function getUserId()
    {
        // define an array to hold user ids
        $this->_usersId = [];
        // loop through users object
        for ($i=0; $i < count($this->_users); $i++) {
            // push user ids to $_userId array
            array_push($this->_usersId, $this->_users[$i]->getUserId());
        }
        // return _usersId array
        return $this->_usersId;
    }


    /**
     * Return all users
     *
     *
     */
    public function getUser()
    {
        return $this->_users;
    }



    public function countUsers()
    {
        return count($this->_users);
    }


  // public function moveCardFromDeck($cardIndex){
  //   array_splice($this->_cards, $cardIndex, 1);
  // }
    public function renderDeck($_backOfCard)
    {
        return $this->_backOfCard = $_backOfCard;
    }


/**
 * @param $cardId
 *
 *
 */

    public function playCard($cardId, $playerIndex)
    {
      $playerHand = $this->_users[$playerIndex]->_cardsOnHand;
      $latestCard = end($this->_thrownCards);
      foreach ($playerHand as $i => $card) {
          if ($card->getCardId() == $cardId) {
          $playedCard = array_splice($this->_users[$playerIndex]->_cardsOnHand, $i, 1)[0];
            if ($playedCard->getCardValue == 8) {
              $this->isEight = true;
              array_push($this->_thrownCards, $playedCard);
            }elseif ($playedCard->getCardValue() == $latestCard->getCardValue() ||
                      $playedCard->getCardSuit() == $latestCard->getCardSuit()) {
              array_push($this->_thrownCards, $playedCard);

            }else{
              //$this->drawCard($playerIndex);
              return $this->drawnCard == true;
            }
        }
      }
      //return $this->_users[$playerIndex]->_cardsOnHand;

    }


public function checkAvailabeCard()
    {
      // Get card on hand for the user that has the turn
      $userHand = $this->_users[$this->playerTurn]->getCardsArray();

      // Get thrownCards array
      $latestCard = end($this->_thrownCards);

      foreach ($userHand as $i => $card) {
        if ($card->getCardId == $latestCard->getCardId || $latestCard->getCardSuit == $card->getCardSuit) {

          $this->drawCard = true;
        }
      }

    }


public function drawCard($index){
    $drawnCard = array_pop($this->_cards);
    $latestCard = end($this->_thrownCards);
    if ($drawnCard->getCardValue() == 8) {
      $this->isEight = true;
      array_push($this->_thrownCards, array_pop($this->_cards));
    }
    elseif ($drawnCard->getCardValue() == $latestCard->getCardValue() || $drawnCard->getCardSuit() == $latestCard->getCardSuit()) {
       array_push($this->_thrownCards, array_pop($this->_cards));
    }
    else {
      array_push($this->_users[$index]->_cardsOnHand, array_pop($this->_cards));
    }
  }


    // public function findCard($cardId, $userIndex)
    // {
    //     $userCardHand = $this->_users[$userIndex]->getCardsArray();
    //     for ($i=0; $i < count($userCardHand); $i++) {
    //         if ($cardId == $userCardHand[$i]->getCardId()) {
    //             return array_splice($userCardHand, $i, 1)[0];
    //         }
    //     }
    //     // foreach ($cardsOnhand as $i => $card) {
    //     //     if ($card->getCardId() == $cardId) {
    //     //         //$card = array_splice($cardsOnhand, $i, 1);
    //     //         //return $card;
    //     //         return array_splice($cardsOnhand, $i, 1);
    //     //     }
    //     // }
    //     //print_r($cardsOnhand);
    // }


    public function getCardOnTable()
    {
        shuffle($this->_cards);
        return $this->_cards;
    }


    /**
     * Get first thrown card
     *
     *
     */

    public function startCard()
    {
         /*  IF no card to start with get one */
        if (empty($this->_thrownCards)) {
            array_push($this->_thrownCards, array_pop($this->_cards));
        }
    }

    public function getThrownCard()
    {
        return $this->_thrownCards;
    }

    /**
     * return user object that hast the turn to play
     *
     *
     */
    public function nextPlayer()
    {

        $this->playerTurn == ($this->countUsers() - 1) ? $this->playerTurn = 0 : $this->playerTurn++;
        //return $this->_users[$this->getNextPlayerIndex()];
    }

    /**
     * return the index of the player that has the turn to play
     *
     *
     */
    public function getPlayerTurn()
    {
        return $this->playerTurn;
    }

    /**
     * set user index that will get the turn to play
     *
     *
     */
    public function setNextPlayerIndex($n)
    {
        $this->playerTurn = $n;
    }

    public function isEight()
    {
        return $this->isEight;
    }



    /**
     * Get $drawCard
     *
     *
     */
    public function getDrawCard()
    {
      return $this->drawCard;
    }
}
