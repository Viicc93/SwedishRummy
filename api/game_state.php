<?php
try {
        // require config file
      require_once '../config/config.php';
      // start session
      Session::startSession();

      // get content from serialize_deck_obj
      $ob_state = file_get_contents(Session::getSession('path_to_serialize_tx'));
      // unserialize deck
      $deck_state = unserialize($ob_state);


      $state =[
                'thrownCards' => $deck_state->getThrownCard()
              ];
        echo json_encode($state);
} catch (Exception $e) {
    echo $e->getMessage();
}
