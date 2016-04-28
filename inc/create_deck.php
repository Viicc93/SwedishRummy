<?php
try {


      /**
       * define constant "URL to serialize_deck_obj.txt" file.
       * this file contains the serialized version of Deck-object
       */

      define('PATH_TO_SERIALIZE_OBJ_FILE', __DIR__ . '/txt/serialize_deck_obj.txt');
      // create session to hold the constant-url PATH_TO_SERIALIZE_OBJ_FILE
      Session::setSession('path_to_serialize_tx', PATH_TO_SERIALIZE_OBJ_FILE);


      $json_file = 'json/cards.json';
      define('PATH_TO_CARDS_JSON_FILE', 'json/cards.json');

      // scan cards dir to get cards url
      $cardsArr = scandir(__DIR__ . '/cards');


  if (!file_exists(Session::getSession('path_to_serialize_tx')) ||
      filesize(Session::getSession('path_to_serialize_tx')) === 0)
  {
    //Session::destroySession();

      // create an empty array to hold card objects
      $cardsMemory = [];

      $countCardsLength = 0;
      $cardId = 0;

      $deck = new Deck();



      // loop through cards url array
      for ($i = 0; $i < count($cardsArr); $i++)
      {
      $countCardsLength++;
      // ignore mac's hidden files that start with "."
      if ($cardsArr[$i] == '..' || $cardsArr[$i] == '.' || $cardsArr[$i] == '.DS_Store') continue;
      // manipulate cards_url array
      array_push($cardsMemory, $cardsArr[$i]);
      //$card_expl = explode(array('.', '_'), $item);
      $split_img_url = preg_split('/[-_.]+/', $cardsArr[$i]);
      $img_url = 'cards/' . $cardsArr[$i];

      $deck->setCards(new Card($i, $split_img_url[0], $split_img_url[2], $img_url));

      $slz_deck = serialize($deck);

      file_put_contents(Session::getSession('path_to_serialize_tx'), $slz_deck);
    }
  }

        $ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
        $selz_deck = unserialize($ob);

} catch (Exception $e) {
  echo $e->getMessage();
}
