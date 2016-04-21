
<?php
try {
	$cardsMemory = [];

	$deck = new Deck();

	$countCardsLength = 0;
	$cardId           = 0;
	// scan cards dir to get cards url
	$cardsArr = scandir('cards');
	// loop through cards url array
	foreach ($cardsArr as $item) {
		$countCardsLength++;
		// ignore mac's hidden files that start with "."
		if ($item == '..' || $item == '.' || $item == '.DS_Store') {continue;
		}

		// manipulate cards_url array
		array_push($cardsMemory, $item);
		//$card_expl = explode(array('.', '_'), $item);
		$split_img_url = preg_split('/[-_.]+/', $item);
		$img_url       = 'cards/'.$item;
		$card_obj      = $deck->setCards(new Card($cardId++, $split_img_url[0], $split_img_url[2], $img_url));
	}

	if (filter_has_var(INPUT_POST, 'submit')) {// if button submit is clicked
		try {

			// require fields
			$required = ['user'];
			// instantiate Validator class
			$val = new Validator($required);
			// filter user input
			$val->removeTags('user');
			// get filtered value
			$filtered = $val->validateInput();
			// get missing fields
			$missing = $val->getMissing();
			// catch errors
			$errors = $val->getErrors();

			if (!$missing && !$errors) {
				$username = $filtered['user'];
				$user     = new User($username);// create user player
				$bot      = new Bot();// create bot player
				$deck->addPlayers($user, $bot);// add players to Deck class

				for ($i = 0; $i < 8; $i++) {// for loop to deal cards to user player cardsOnHand array
					$card_obj      = $deck->getCards();// get card array
					$userCardIndex = mt_rand(0, count($card_obj));// count array and get a random index for card
					$botCardIndex  = mt_rand(0, count($card_obj));
				}
			}
			/* for ($i=0; $i < 8; $i++) { // for loop to deal cards to user player cardsOnHand array
		$card_obj = $deck->getCards(); // get card array
		$userCardIndex = mt_rand(0, count($card_obj)); // count array and get a random index for card
		$botCardIndex = mt_rand(0, count($card_obj));

		if ($userCardIndex != $botCardIndex) {


		$user->dealCard($card_obj[$userCardIndex]); // send card to dealCard() and push to cardsOnHand array
		$deck->moveCardFromDeck($userCardIndex); // remove dealed card from deck

		$bot->dealCard($card_obj[$botCardIndex]);
		$deck->moveCardFromDeck($bodCardIndex);
		}
		}
		}
		if ($missing) {
		// Sets sessions to show the missing fields
		Session::flashSession('missing',$missing);
		// destroy missing session
		Session::destroySession();



		}*/
		} catch (Exception $e) {
			echo $e;
		}
	}
} catch (Exception $e) {
	echo $e;
}
