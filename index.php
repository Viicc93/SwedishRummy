<?php
	// require config file
	require_once 'config/config.php';
	Session::startSession();
	Session::display();
	define('PATH_TO_SERIALIZE_OBJ_FILE', 'txt/serialize_deck_obj.txt');
	ini_set('display_startup_errors',1);
	ini_set('display_errors',1);
	error_reporting(-1);
	$allCards = [];
	$json_file = 'json/cards.json';
	define('PATH_TO_CARDS_JSON_FILE', 'json/cards.json');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
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
          <footer></footer>
        </div><!-- end #table -->
        </div><!-- end wrap -->
      </div><!-- end row -->
    </div><!-- end container -->
  </body>
						<?php
							$ob = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
							$selz_deck = unserialize($ob);
						?>
						<script>
                var deck_users = JSON.parse('<?php echo json_encode($selz_deck->getUser()); ?>');
						</script>
</html>
