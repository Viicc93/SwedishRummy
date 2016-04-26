<?php require_once 'create_deck.php';
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

            </div><!-- end user-form -->
        </div><!-- end navbar-header -->
      </div>
    </nav>
  </header>
    <div class="container">
      <div class="row">
<?php echo $selz_deck->countUsers(); ?>


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
          </div><!-- end messages -->


          <div class="cards_on_table">
          <?php $cardsOnTable = $selz_deck->getCardOnTable(); ?>
            <?php for($i=0; $i < count($cardsOnTable); $i++): ?>
            <a data-cardId="<?php echo $cardsOnTable[$i]->getCardId() ?>"><img src="<?php echo  $cardsOnTable[$i]->getCardHref();?>" alt=""></a>
            <?php endfor; ?>
          </div><!-- end cards_on_table -->

          <footer></footer>
        </div><!-- end #table -->
        </div><!-- end wrap -->
      </div><!-- end row -->
    </div><!-- end container -->
  </body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="js/custom/classes.js" type="text/javascript" charset="utf-8" async defer></script>
    <script src="js/custom/main.js" type="text/javascript" charset="utf-8" async defer></script>


</html>
