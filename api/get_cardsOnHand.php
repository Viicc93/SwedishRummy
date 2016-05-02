<?php
	require_once "../config/config.php";

	Session::startSession();
  $ob = file_get_contents(Session::getSession('path_to_serialize_tx'));
  $selz_deck = unserialize($ob);
  echo json_encode($selz_deck->showCardsOnHand());
  ?>