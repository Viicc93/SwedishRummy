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
      $ob_state = file_get_contents(Session::getSession('path_to_serialize_tx'));
      // unserialize deck
      $unlz_state = unserialize($ob_state);


      $state = array(
                      'lastThrownCard' => $unlz_state->getThrownCard()[0],
                      'nextPlayer' => $unlz_state->getNextPlayerIndex(),
                      'thrownCardArray' => $unlz_state->getThrownCard(),
                      'users' => $unlz_state->getUser(),
                      'countUsers' => $unlz_state->countUsers(),
                      'botCardsOnhands' => $unlz_state->botCardOnHand()
                    );
        echo json_encode($state);


  }catch(Exception $e) {
  echo $e->getMessage();
}

