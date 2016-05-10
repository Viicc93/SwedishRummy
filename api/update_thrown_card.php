<?php
try {
    // require config file
    require_once '../config/config.php';
  // start session
    Session::startSession();

  // get content from serialize_deck_obj
    $ob = file_get_contents(Session::getSession('path_to_serialize_tx'));
  // unserialize deck
    $selz_deck = unserialize($ob);
    echo json_encode($selz_deck->getThrownCard());
    //file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($selz_deck));

} catch (Exception $e) {
    echo $e->getMessage();
}
