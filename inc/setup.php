<?php

    require_once '../config/config.php';
    Session::startSession();

  if (filter_has_var(INPUT_POST, 'submit'))
  { // if button submit is clicked
    try {

         // require fields
         $required = ['user'];
         // instantiate Validator class
         $val = new Validator($required);
         // filter user input
         $val->removeTags('user');
         // get filtered value
         $filtered   = $val->validateInput();
         // get missing fields
         $missing  = $val->getMissing();
         // catch errors
         $errors   = $val->getErrors();
         /*
         * check that there is no missing field or errors
         * that returned from Validator-class
         */
         if (!$missing && !$errors)
         {

          // get filtered username returned from Validator-class
          $username = $filtered['user'];
          $user = new User($username); // create user player


            // set user id to session
            Session::setSession('user-id', $user->getUserId());


          $deck_ob = file_get_contents(Session::getSession('path_to_serialize_tx'));
          $unSrlz_deck = unserialize($deck_ob);

          $unSrlz_deck->addPlayers($user); // add players to Deck class
          $unSrlz_deck->startCard();

          file_put_contents(Session::getSession('path_to_serialize_tx'), serialize($unSrlz_deck));

          if (count($unSrlz_deck->getUser()) === 4)
          {
            Session::flashSession('errorMessage', 'This game is full!');
          }
      }

      /*
      * If user tries to join without username,
      * will get a flash message tells that
      * the username is required.
      */
      if ($missing) {
        // Sets sessions to show the missing fields
        Session::flashSession('missing',$missing);
      }
      Redirect::toPage('../index.php');

    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }
