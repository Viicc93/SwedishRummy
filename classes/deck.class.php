<?php
class Deck {

	/**
	 * Card array
	 *
	 * @var array
	 */
	public $_cards;
	// public $_cardsOnTable;
	public $_backOfCard;
	public $_users;
	public $_card;
	public $_usersId;
	public $_thrownCards;

	/**
	 * The constructor define $_cards array,
	 *  _cardsOnTable and _users arrays.
	 * It calls addBotPlayer() method to
	 * instantiate Bot-class.
	 */
	public function __construct() {
		$this->_cards = [];
		//   $this->_cardsOnTable = [];
		$this->_users       = [];
		$this->_thrownCards = [];

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
	public function setCards(Card $card) {
		$this->_card = $card;
		// push card object to $_cards array
		array_push($this->_cards, $card);
	}

	public function getCards() {
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
	public function addPlayers(User $user) {
		if (count($this->_users) < 4) {
			// push user object to _users array
			array_push($this->_users, $user);
		}
		// call dealCardToPlayers method
		$this->dealCardToPlayers();
	}

	public function addBotPlayer() {
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
	public function dealCardToPlayers() {
		// shuffle _cards array
		shuffle($this->_cards);
		// loop through _users array
		for ($i = 0; $i < count($this->_users); $i++) {
			for ($j = 0; $j < 8; $j++) {
				if (count($this->_users[$i]->_cardsOnHand) < 8) {
					// pop a card-item and push it into _cardsOnHand array
					array_push($this->_users[$i]->_cardsOnHand, array_pop($this->_cards));
				}
			}
		}
	}

	public function showCardsOnHand() {

		for ($i = 0; $i < count($this->_users); $i++) {
			$cards = $this->_users[$i]->getCardsArray();
		}
		return $cards;
	}

	/**
	 * getUserId() method is a method that looping through
	 * user objects, and by using getUserId() method which is
	 * in user object, it will return the array _userId.
	 */
	public function getUserId() {
		// define an array to hold user ids
		$this->_usersId = [];
		// loop through users object
		for ($i = 0; $i < count($this->_users); $i++) {
			// push user ids to $_userId array
			array_push($this->_usersId, $this->_users[$i]->getUserId());
		}
		// return _usersId array
		return $this->_usersId;
	}

	public function getUser() {
		return $this->_users;
	}

	public function countUsers() {
		return count($this->_users);
	}

	// public function moveCardFromDeck($cardIndex){
	//   array_splice($this->_cards, $cardIndex, 1);
	// }
	public function renderDeck($_backOfCard) {
		return $this->_backOfCard = $_backOfCard;
	}

	/**
	 * @param $id
	 *
	 *
	 */

	public function moveThrownCards($id, $userId) {
		for ($k = 0; $k < count($this->_users); $k++) {
			if ($userId === $this->_users[$k]->getUserId()) {

				$cardsOnHand = $this->_users[$k]->_cardsOnHand;
				for ($j = 0; $j < count($cardsOnHand); $j++) {
					for ($i = 0; $i < count($cardsOnHand); $i++) {

						if ($id === $cardsOnHand[$i]->getCardId()) {
							$index = $i+1;
							//array_push($this->_thrownCards, array_splice($cardsOnHand, $index, 1));
							return false;
						}
					}
				}
			}
		}
	}

	public function getCardOnTable() {
		for ($i = 0; $i < count($this->_cards); $i++) {
			array_push($this->_cardsOnTable, $this->_cards[$i]);
		}
		shuffle($this->_cards);
		return $this->_cards;
	}
	public function startCard() {
		/*  IF no card to start with get one */
		if (empty($this->_thrownCards)) {
			array_push($this->_thrownCards, array_pop($this->_cards));
		}
	}

	public function getThrownCard() {
		return $this->_thrownCards;
	}
}
