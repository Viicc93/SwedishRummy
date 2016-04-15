<?php
  // require config file
  require_once 'config/config.php';

  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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



?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="css/style.css" type="text/css" rel="stylesheet" />
  <title>Swedish Rummy</title>
</head>
<body>

<header><h1>Swedish Rummy</h1></header>

<div id="wrap">

<div id="table">

<div class="row">
	<div class="player player3">
		<div class="avatar"></div>
			<div class="hand hand3">
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
			</div>
		</div>
	</div>

<div class="row middle-row">

	<div class="player player1">
	<div class="avatar"></div>
		<div class="hand">
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
		</div>
	</div>

	<div id="cardBox">
	<div id="deck"></div>
	<div id="playedCard"></div>
	</div>
	<div id="messageBox">HEJEHEJEJHEJEJEHJ</div>

	<div class="player player2">
		<div class="avatar"></div>
		<div class="hand">
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
		</div>
	</div>

</div>

<div class="row">
	<div class="player player4">
		<div class="avatar"></div>
			<div class="hand">
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
			</div>
	</div>
</div>

</div>

</div>

<footer></footer>

</body>
</html>

