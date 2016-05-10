<?php
try {
      // require config file
      require_once 'config/config.php';
      // start session
      Session::startSession();
      $next = null;
      //Session::display();
      /**
       * define constant "URL to serialize_deck_obj.txt" file.
       * this file contains the serialized version of Deck-object
       */
      define('PATH_TO_SERIALIZE_OBJ_FILE', __DIR__ . '/txt/serialize_deck_obj.txt');
      // create session to hold the constant-url PATH_TO_SERIALIZE_OBJ_FILE
      Session::setSession('path_to_serialize_tx', PATH_TO_SERIALIZE_OBJ_FILE);

      ini_set('display_startup_errors', 1);
      ini_set('display_errors', 1);
      error_reporting(-1);

      $json_file = 'json/cards.json';
      define('PATH_TO_CARDS_JSON_FILE', __DIR__ . '/json/game_status.json');

      // create session to hold the constant-url PATH_TO_SERIALIZE_OBJ_FILE
      Session::setSession('path_to_json_file', PATH_TO_CARDS_JSON_FILE);

      // scan cards dir to get cards url
      $cardsArr = scandir(__DIR__ . '/cards');
    if (!file_exists(Session::getSession('path_to_serialize_tx')) ||
      filesize(Session::getSession('path_to_serialize_tx')) === 0) {
    //Session::destroySession();
        // create an empty array to hold card objects
        $cardsMemory = [];
        // $ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
        // $selz_deck = unserialize($ob);
        // $deck = new Deck();
        $countCardsLength = 0;
        $cardId = 0;
        $deck = new Deck();
        // loop through cards url array
        for ($i = 0; $i < count($cardsArr); $i++) {
            $countCardsLength++;
        // ignore mac's hidden files that start with "."
            if ($cardsArr[$i] == '..' || $cardsArr[$i] == '.' || $cardsArr[$i] == '.DS_Store') {
                continue;
            }
        // manipulate cards_url array
            array_push($cardsMemory, $cardsArr[$i]);
        //$card_expl = explode(array('.', '_'), $item);
            $split_img_url = preg_split('/[-_.]+/', $cardsArr[$i]);
            $img_url = 'cards/' . $cardsArr[$i];
            $deck->setCards(new Card($i, $split_img_url[0], $split_img_url[2], $img_url));

            $slz_deck = serialize($deck);
            file_put_contents(Session::getSession('path_to_serialize_tx'), $slz_deck);
        }
    }
        $ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
        $selz_deck = unserialize($ob);

        //print_r($selz_deck->getCardOnHand());
        //require_once 'inc/game_status.php';

        //$selz_deck->moveThrownCards(17, Session::getSession('user-id'));
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link href="dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
    <title>Swedish Rummy</title>
  </head>
<body>

  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header col-md-12">
          <div class="brand"><h2><a class="navbar-brand" href="#">Swedish Rummy</a></h2></div><!-- end brand -->


            <div class="navbar-form navbar-left user-form">
            <form method="POST" action="inc/setup.php" class="navbar-form navbar-left">
              <div class="form-group">
              <!-- <span class="input-group-addon glyphicon glyphicon-user" id="basic-addon1"></span> -->
                <input type="text" name="user" class="join form-control" placeholder="Username">
              </div>
              <button type="submit" name="submit" class="btn btn-default">Join</button>
            </form>

            <div class="count-users"><p>We have: <?php echo $selz_deck->countUsers(); ?> players on this table!</p></div><!-- end count-users -->
            </div><!-- end user-form -->
        </div><!-- end navbar-header -->
      </div>
    </nav>
  </header>
    <div class="container">
      <div class="row">


        <div id="wrap" class="col-md-12">
          <div id="table">
          <div class="messages">
            <?php
              /**
               * If the game is full, means if there is
               * 4 players will show a flash message.
               */
            if (Session::getSession('errorMessage')) {
                // echo errors message
                echo Session::flashSession('errorMessage');
              /**
               * If user didn't enter a valid user name,
               * will show a flash message.
               */
            } elseif (Session::getSession('missing')) {
              // show missing username message
                $missing =  Session::flashSession('missing');
                foreach ($missing as $field) {
                    switch ($field) {
                        case 'user':
                            echo "User name is required! Please write you user name.";
                            break;
                    }
                }
            }
            ?>
          </div><!-- end messages -->


          <footer></footer>
        </div><!-- end #table -->
        </div><!-- end wrap -->
      </div><!-- end row -->
    </div><!-- end container -->
  </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/custom/main.js" type="text/javascript" charset="utf-8" async defer></script>

            <script>
                var player_id = '<?php echo Session::getSession("user-id"); ?>';
            </script>
</html>
