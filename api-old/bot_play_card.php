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

    $turn = 0;

    $req = new Request();
    if ($req->resExists() && $req->getRequest('turn') ==  $turn) {
        $selz_deck->botPlayCard();
        $selz_deck->setNextPlayerIndex($turn++);
    }





    file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($selz_deck));
    echo json_encode($selz_deck->botPlayCard());

  //     // get content from serialize_deck_obj
  //   $ob_ser = file_get_contents(Session::getSession('path_to_serialize_tx'));
  // // unserialize deck
  //   $unSer = unserialize($ob_ser);


  //   echo json_encode($unSer->botCardOnHand());


  // instantiate Request-class
  // $req = new Request();
  // if ($req->resExists() && $req->getRequest('turn') === 0) {
  //   echo $req->getRequest('turn');
  //   // $cardId = $req->getRequest('cardId');
  //   // $playerTurn = $req->getRequest('playerTurn');
  //   // $playerTurn++;

  //   // $selz_deck->playCard($cardId, Session::getSession('user-id'));
  //   // $selz_deck->setNextPlayerIndex($playerTurn);
  //   // $selz_deck->nextPlayer($index);
  //   // //echo json_encode($selz_deck->getThrownCard());
  //   //file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($selz_deck));

  // }else{
  //   echo "Nothing";
  // }
} catch (Exception $e) {
    echo $e->getMessage();
}
