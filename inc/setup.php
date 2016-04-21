<?php
try {
	// create an empty array to hold card objects
	$cardsMemory      = [];
	$deck             = new Deck();
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
		$deck->setCards(new Card($cardId++, $split_img_url[0], $split_img_url[2], $img_url));
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
			/*
			 * check that there is no missing field or errors
			 * that returned from Validator-class
			 */
			if (!$missing && !$errors) {
				// get filtered username returned from Validator-class
				$username = $filtered['user'];
				$user     = new User($username);// create user player
				$deck->addPlayers($user);// add players to Deck class
			}
			/*
			 * If user tries to join without username,
			 * will get a flash message tells that
			 * the username is required.
			 */
			if ($missing) {
				// Sets sessions to show the missing fields
				Session::flashSession('missing', $missing);
				// destroy missing session
				Session::destroySession();
			}
			echo "<pre>";
			print_r($deck->getUser());
		} catch (Exception $e) {
			echo $e;
		}
	}
} catch (Exception $e) {
	echo $e;
}
