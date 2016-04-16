<?php
try {
  // drfine json file url
  //$json_file = 'json/cards.json';
  //define(PATH_TO_CARDS_JSON_FILE, 'json/cards.json');
  // create an empty array to hold cards url:s
  $cardsMemory = [];
  $cardsObjMemory = [];

  $deck = new Deck();


  $countCardsLength = 0;
  $cardId = 0;
  // check if cards.json exists
  //if (!file_exists(PATH_TO_CARDS_JSON_FILE, 'w+')) {
    // create cards.json file
    //$fp = fopen(PATH_TO_CARDS_JSON_FILE, 'w+');
    //fclose($fp);
    // scan cards dir to get cards url
    $cardsArr = scandir('cards');
    // loop through cards url array
    foreach ($cardsArr as $item) {
    $countCardsLength++;
    // ignore mac's hidden files that start with "."
    if ($item == '..' || $item == '.' || $item == '.DS_Store') continue;
    // manipulate cards_url array
    array_push($cardsMemory, $item);
    //$card_expl = explode(array('.', '_'), $item);
    $split_img_url = preg_split('/[-_.]+/', $item);
    $img_url = 'cards/' . $item;
    $card_obj = $deck->setCards(new Card($cardId++, $split_img_url[0], $split_img_url[2], $img_url));
    //file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($card_obj, JSON_FORCE_OBJECT));

    // echo "<pre>";
    // print_r($split_img_url);

    // prevent duplicated items in cards array
    // if (count($cardsArr) === $countCardsLength) {
    // // save results to cards.json
    // //file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($card, JSON_FORCE_OBJECT));
    // }
  }
//};
//$deck->getCards();
// echo '<pre>';

// print_r($deck->getCards());

$card_obj = $deck->getCards();


	if (isset($_POST['submit'])){
		$userName = $_POST['user'];

		$user = new User($userName);
		$bot = new Bot();
		$deck->addPlayers($user, $bot);

		for ($i=0; $i < 8; $i++) {
			$randCard = rand(0, count($card_obj)-1);
			$user->dealCard($card_obj[$randCard]);
			array_splice($card_obj, $randCard, 1);
		}

		for ($j=0; $j < 8; $j++) {
			$randCard = rand(0, count($card_obj)-1);
			$bot->dealCard($card_obj[$randCard]);
			array_splice($card_obj, $randCard, 1);
		}

		echo "<pre>";
		print_r($card_obj);
		//var_dump($user);
		//var_dump($bot);

	}

} catch (Exception $e) {
	echo $e;
}



?>