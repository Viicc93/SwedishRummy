<?php
try {
    // require config file
    require_once '../config/config.php';
  // start session
    Session::startSession();

  // get content from game_queue.php
  // $json = file_get_contents(Session::getSession('path_to_json_file'));
  // $game_status = json_decode($json);

  // get content from serialize_deck_obj
    $ob = file_get_contents(Session::getSession('path_to_serialize_tx'));
  // unserialize deck
    $selz_deck = unserialize($ob);




    /*
     * Check if the value is 0 that means
     * the player is the Bot (the computer)
    */
    if ($selz_deck->getNextPlayerIndex() == 0) {
      // get users form Deck-object
        $users = $selz_deck->getUser();
      // loop through users
      //for ($i=0; $i < count($users); $i++) {
        $bot_obj = $users[0]->getBotObj();
        $card = $bot_obj->PlayCard();
        $selz_deck->botPlayCard($card);

        file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($selz_deck));
        //print_r($bot_obj);
        //$selz_deck->botPlayCard($theCard);
        $ser = file_get_contents(Session::getSession('path_to_serialize_tx'));
        $ob = unserialize($ser);
        print_r($ob->getThrownCard());
      //}
    } else {
        print_r($selz_deck->nextPlayer($index));
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
