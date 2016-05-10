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

  // instantiate Request-class
    $req = new Request();
    if ($req->resExists() && $req->getRequest('userId') === Session::getSession('user-id')) {
        $cardId = $req->getRequest('cardId');
        $playerTurn = $req->getRequest('playerTurn');
        $playerTurn++;

        $selz_deck->playCard($cardId, Session::getSession('user-id'));
        $selz_deck->setNextPlayerIndex($playerTurn);
        $selz_deck->nextPlayer($cardId, Session::getSession('user-id'));
        //echo json_encode($selz_deck->getThrownCard());
        file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($selz_deck));
    } else {
        echo "Nothing";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
