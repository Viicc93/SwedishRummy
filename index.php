<?php
  // require config file
  require_once 'config/config.php';
  // drfine json file url
  //$json_file = 'json/cards.json';
  define(PATH_TO_CARDS_JSON_FILE, 'json/cards.json');
  // create an empty array to hold cards url:s
  $cardsMemory = [];
  $cardsObjMemory = [];

  $deck = new Deck();


  $countCardsLength = 0;
  $cardId = 0;
  // check if cards.json exists
  if (!file_exists(PATH_TO_CARDS_JSON_FILE, 'w+')) {
    // create cards.json file
    $fp = fopen(PATH_TO_CARDS_JSON_FILE, 'w+');
    fclose($fp);
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
    $card_obj = $deck->setCards(new Card($cardId++, $split_img_url[0], $split_img_url[2], $item));
    //file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($card_obj, JSON_FORCE_OBJECT));

    // echo "<pre>";
    // print_r($split_img_url);

    // prevent duplicated items in cards array
    // if (count($cardsArr) === $countCardsLength) {
    // // save results to cards.json
    // //file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($card, JSON_FORCE_OBJECT));
    // }
  }
};
    echo "<pre>";
    print_r($deck);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="css/style.css" type="text/css" rel="stylesheet" />
  <title>Swedish Rummy</title>
</head>
<body>

</body>
</html>

