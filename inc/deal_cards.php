<?php
  require_once '../config/config.php';
  Session::startSession();

  if (filter_has_var(INPUT_POST, 'deal'))
  {

    try {
        // get the serialized version of Deck-object
        $ob = file_get_contents(Session::getSession('path_to_serialize_tx'));
        $selz_deck = unserialize($ob);
        print_r($selz_deck->showCardsOnHand());
        //Redirect::toPage('../index.php');

    } catch (Exception $e) {
      echo $e;
    }
  }
