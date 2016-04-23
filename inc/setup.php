<?php
    require_once '../config/config.php';
    Session::startSession();
try {

  define('PATH_TO_SERIALIZE_OBJ_FILE', '../txt/serialize_deck_obj.txt');

  if (!file_exists(PATH_TO_SERIALIZE_OBJ_FILE) || filesize(PATH_TO_SERIALIZE_OBJ_FILE) === 0)
  {

      // create an empty array to hold card objects
      $cardsMemory = [];
      // $ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
      // $selz_deck = unserialize($ob);
      // $deck = new Deck();
      $countCardsLength = 0;
      $cardId = 0;

      $deck = new Deck();


      // scan cards dir to get cards url
      $cardsArr = scandir('../cards');
      // loop through cards url array
      for ($i = 0; $i < count($cardsArr); $i++)
      {
      $countCardsLength++;
      // ignore mac's hidden files that start with "."
      if ($item == '..' || $item == '.' || $item == '.DS_Store') continue;
      // manipulate cards_url array
      array_push($cardsMemory, $cardsArr[$i]);
      //$card_expl = explode(array('.', '_'), $item);
      $split_img_url = preg_split('/[-_.]+/', $cardsArr[$i]);
      $img_url = 'cards/' . $item;
      echo $img_url;

      $deck->setCards(new Card($i, $split_img_url[0], $split_img_url[2], $img_url));

      $slz_deck = serialize($deck);

      file_put_contents(PATH_TO_SERIALIZE_OBJ_FILE, $slz_deck);
    }
  }

  if (filter_has_var(INPUT_POST, 'submit'))
  { // if button submit is clicked
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
         if (!$missing && !$errors)
         {

          // get filtered username returned from Validator-class
          $username = $filtered['user'];
          $user = new User($username); // create user player
          // set user id to session
          Session::setSession('user-id', $user->getUserId());

          $deck_ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
          $unSrlz_deck = unserialize($deck_ob);
          $unSrlz_deck->addPlayers($user); // add players to Deck class
          file_put_contents(PATH_TO_SERIALIZE_OBJ_FILE, serialize($unSrlz_deck));
          //echo count($unSrlz_deck->getUser());
          if (count($unSrlz_deck->getUser()) === 4)
          {
            Session::flashSession('errorMessage', 'This game is full!');
          }
      }

      /*
      * If user tries to join without username,
      * will get a flash message tells that
      * the username is required.
      */
      if ($missing) {
        // Sets sessions to show the missing fields
        Session::flashSession('missing',$missing);
      }
      Redirect::toPage('../index.php');

    } catch (Exception $e) {
      echo $e;
    }
  }
} catch (Exception $e) {
  echo $e;
}
