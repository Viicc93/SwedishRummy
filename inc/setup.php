<?php
require_once '../config/config.php';
try {

  define('PATH_TO_SERIALIZE_OBJ_FILE', '../txt/serialize_deck_obj.txt');

  if (!file_exists(PATH_TO_SERIALIZE_OBJ_FILE)) {

  // create an empty array to hold card objects
  $cardsMemory = [];
    // $ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
    // $selz_deck = unserialize($ob);
  //$deck = new Deck();
  $countCardsLength = 0;
  $cardId = 0;

    $deck = new Deck();


    // scan cards dir to get cards url
    $cardsArr = scandir('../cards');
    // loop through cards url array
    foreach ($cardsArr as $item) {
    $countCardsLength++;
    // ignore mac's hidden files that start with "."
    if ($item == '..' || $item == '.' || $item == '.DS_Store') continue;
    // manipulate cards_url array
    array_push($cardsMemory, $item);
    //$card_expl = explode(array('.', '_'), $item);
    $split_img_url = preg_split('/[-_.]+/', $item);
    $img_url = '../cards/' . $item;

    $deck->setCards(new Card($cardId++, $split_img_url[0], $split_img_url[2], $img_url));

    $slz_deck = serialize($deck);

    file_put_contents(PATH_TO_SERIALIZE_OBJ_FILE, $slz_deck);
  }


  }

  if (filter_has_var(INPUT_POST, 'submit')){ // if button submit is clicked
    try {

           // require fields
           $required = ['user'];
           // instantiate Validator class
           $val = new Validator($required);
           // filter user input
           $val->removeTags('user');
           // get filtered value
           $filtered   = $val->validateInput();
           // get missing fields
           $missing  = $val->getMissing();
           // catch errors
           $errors   = $val->getErrors();
           /*
           * check that there is no missing field or errors
           * that returned from Validator-class
           */
           if (!$missing && !$errors) {

            // get filtered username returned from Validator-class
            $username = $filtered['user'];
            $user = new User($username); // create user player

            $deck_ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
            $unSrlz_deck = unserialize($deck_ob);
            $unSrlz_deck->addPlayers($user); // add players to Deck class
            file_put_contents(PATH_TO_SERIALIZE_OBJ_FILE, serialize($unSrlz_deck));
      }
      /*
      * If user tries to join without username,
      * will get a flash message tells that
      * the username is required.
      */
      if ($missing) {
        // Sets sessions to show the missing fields
        Session::flashSession('missing',$missing);
        // destroy missing session
        Session::destroySession();
      }
      header('Location: ../index.php');

    } catch (Exception $e) {
      echo $e;
    }
  }
} catch (Exception $e) {
  echo $e;
}
