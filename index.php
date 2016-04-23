<?php
	// require config file
	require_once 'config/config.php';
  // start session
	Session::startSession();
	Session::display();


  /**
   * define constant "URL to serialize_deck_obj.txt" file.
   * this file contains the serialized version of Deck-object
   */

	define('PATH_TO_SERIALIZE_OBJ_FILE', 'txt/serialize_deck_obj.txt');

	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);

	$json_file = 'json/cards.json';
	define('PATH_TO_CARDS_JSON_FILE', 'json/cards.json');

    $ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
    $selz_deck = unserialize($ob);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/custom/classes.js" type="text/javascript" charset="utf-8" async defer></script>
    <script src="js/custom/main.js" type="text/javascript" charset="utf-8" async defer></script>
		<title>Swedish Rummy</title>
	</head>
<body>

	<header><h1>Swedish Rummy</h1></header>
		<div class="container">
			<div class="row">


				<div id="wrap">
					<div id="table">
					<div class="messages">
						<?php

              /**
               * If the game is full, mean if there is
               * 4 players will show a flash message.
               */
							if (Session::getSession('errorMessage')) {
                  // echo errors message
									echo Session::flashSession('errorMessage');

              /**
               * If user didn't enter a valid user name,
               * will show a flash message.
               */
								}elseif (Session::getSession('missing')) {
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
					</div>
						<div class="col-md-12 user-form">

						<form method="POST" action="inc/setup.php" class="navbar-form navbar-left">
						  <div class="form-group">
						  <!-- <span class="input-group-addon glyphicon glyphicon-user" id="basic-addon1"></span> -->
						    <input type="text" name="user" class="join form-control" placeholder="Username">
						  </div>
						  <button type="submit" name="submit" class="btn btn-default">Join</button>
						</form>

						</div><!-- end user-form -->

            <!--
            create users container that has data attribute as user id.
            this foreach statment will generate 4 divs, one div for every player.
            -->
            <?php //foreach($selz_deck->getUserId() as $id): ?>

              <!-- <div class="game_users" data-user-id="<?php //echo $id ?>"> -->

              </div><!-- end game_users -->

            <?php //endforeach; ?>

          <footer></footer>
        </div><!-- end #table -->
        </div><!-- end wrap -->
      </div><!-- end row -->
    </div><!-- end container -->
  </body>

						<script>
                var deck_users = JSON.parse('<?php echo json_encode($selz_deck->getUser()); ?>');
                var player_id = '<?php echo Session::getSession("user-id"); ?>';
						</script>
</html>
