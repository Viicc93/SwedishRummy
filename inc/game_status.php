<?php
try {
    // check if json/game_status.json file exists and it's not empty
    if (!file_exists(Session::getSession('path_to_json_file')) ||
      filesize(Session::getSession('path_to_json_file')) === 0) {

      /**
       * status array will be converted to a json object
       * this array is holding game's queue, if the card
       * that will be thrown is eight
       */
      $status = ["whichPlayer" => 0, "isEight" => null];
      // put status array into game_status.json file
      file_put_contents(Session::getSession('path_to_json_file'), json_encode($status));
    }
} catch (Exception $e) {
  echo $e->getMessage();
}
