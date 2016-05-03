<?php
try {
    // require config file
  require_once '../config/config.php';
  // start session
  Session::startSession();

  // get content from game_queue.php
  $json = file_get_contents(Session::getSession('path_to_json_file'));
  $game_status = json_decode($json);

  // get content from serialize_deck_obj
  $ob = file_get_contents(Session::getSession('path_to_serialize_tx'));
  // unserialize deck
  $selz_deck = unserialize($ob);

  // instantiate Request-class
  $req = new Request();
//echo $game_status->whichPlayer;
//print_r($game_status);
  if ($req->resExists()) {
  $index = $req->getRequest('indx');
  print_r($selz_deck->nextPlayer($index));


    // file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($selz_deck));

  }

} catch (Exception $e) {
  echo $e->getMessage();
}
