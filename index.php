<?php
// require config file
require_once 'config/config.php';
require_once 'inc/setup.php';
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
$allCards  = [];
$json_file = 'json/cards.json';
define('PATH_TO_CARDS_JSON_FILE', 'json/cards.json');
define('PATH_TO_SERIALIZE_OBJ_FILE', 'txt/serialize_obj.txt');
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
            <div class="col-md-12 user-form">

            <form method="POST" class="navbar-form navbar-left">
              <div class="form-group">
              <!-- <span class="input-group-addon glyphicon glyphicon-user" id="basic-addon1"></span> -->
                <input type="text" name="user" class="form-control" placeholder="Username">
              </div>
              <button type="submit" name="submit" class="btn btn-default">Join</button>
            </form>

            </div><!-- end user-form -->
            <div class="col-md-12 bot-user">
            <!-- show messages -->
            <div class="messages">
              <!-- check if missing fields session has been started -->
<?php if (Session::getSession('missing')):?>
<!-- assign missing array to $missing variable -->
<?php $missing = Session::flashSession('missing');?>
<!-- loop through $missing variable -->
<?php foreach ($missing as $field):?>
                  <?php switch ($field) {
	case 'user':
		?>
		<p>OBS: You forget to cheese a User Name!</p>

		<?php break;}?>
                <?php endforeach;?>
              <?php endif;?>
</div><!-- end messages -->
            <h2>Bot user</h2>
<?php if (filter_has_var(INPUT_POST, 'submit')):?>
              <?php $username  = $_POST['user'];?>
              <?php $gameUsers = $deck->getUser();?>
              <?php foreach ($gameUsers as $user):?>
                <?php if ($user->name !== $username):?>
                  <div class="bot-data">
                    <p><?php echo $user->name?></p>
<?php
// $allCards['botUser'] = ['bot' => $user->name, 'cards' => $user->getCardsArray()];
// $allCards['invisibleCardsOnTable'] = ['cardsOnTable' => $deck->getCardOnTable()];
// $allCards['visibleCardsOnTable'] = [];
// file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($allCards, JSON_FORCE_OBJECT));
// file_put_contents(PATH_TO_SERIALIZE_OBJ_FILE, serialize($deck));
// $obj = file_get_contents(PATH_TO_SERIALIZE_OBJ_FILE);
// print_r(unserialize($obj));
?>
                  </div><!-- end bot-data -->
                  <div data-userId="<?php echo $user->getId();?>" class="cards-on-table-users bot-cards">
<?php for ($i = 0; $i < count($user->getCardsArray()); $i++):?>
                      <div class="card-pos">

                      <a href="" data-id="<?php echo $user->getCardsArray()[$i]->getCardId();?>"><img src="<?php echo $user->getCardsArray()[$i]->getCardHref();?>" alt=""></a>
                      </div><!-- end card-pos -->
<?php endfor;?>
</div><!-- end bot-cards -->
            </div><!-- end bot-user -->
<?php  else :?>
                  <div data-userId="<?php echo $user->getId();?>" class="cards-on-table-users user-cards">
<?php //$allCards['humanUser'] = ['user1' => $username, 'cards' => $user->getCardsArray()] ?>
                  <?php //file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($allCards, JSON_PRETTY_PRINT));?>
<h3>User Cards</h3>

<?php for ($i = 0; $i < count($user->getCardsArray()); $i++):?>
                      <div class="card-pos">

                      <a href="" data-id="<?php echo $user->getCardsArray()[$i]->getCardId();?>"><img src="<?php echo $user->getCardsArray()[$i]->getCardHref();?>" alt=""></a>
                      </div><!-- end card-pos -->
<?php endfor;?>
</div><!-- end user-cards -->
<?php endif;?>
              <?php endforeach;?>
            <?php endif;?>
<div class="middle-row col-md-4">

<?php
// $deck->setCardsOnTableBackSideUrl('img/back_of_card.png');
$back_side = $deck->getCardOnTable();
foreach ($back_side as $key => $value):
?>
              <div class="cards_on_table"><a data-id="<?php echo $value->getCardId();?>"><img style="z-index: <?php echo $key;?>; right: <?php echo $key/2;?>px" src="<?php echo $value->href?>" alt=""></a></div>
<?php endforeach;?>
</div><!-- end middle-row -->

          <footer></footer>
        </div><!-- end #table -->
        </div><!-- end wrap -->
      </div><!-- end row -->
    </div><!-- end container -->
  </body>
</html>
