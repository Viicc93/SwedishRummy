<?php
<<<<<<< HEAD
// require config file
require_once 'config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// drfine json file url
//$json_file = 'json/cards.json';
//define(PATH_TO_CARDS_JSON_FILE, 'json/cards.json');
// create an empty array to hold cards url:s
$cardsMemory    = [];
$cardsObjMemory = [];

$deck = new Deck();

$countCardsLength = 0;
$cardId           = 0;
// check if cards.json exists
//if (!file_exists(PATH_TO_CARDS_JSON_FILE, 'w+')) {
// create cards.json file
//$fp = fopen(PATH_TO_CARDS_JSON_FILE, 'w+');
//fclose($fp);
// scan cards dir to get cards url
$cardsArr = scandir('cards');
// loop through cards url array
foreach ($cardsArr as $item) {
	$countCardsLength++;
	// ignore mac's hidden files that start with "."
	if ($item == '..' || $item == '.' || $item == '.DS_Store') {continue;
	}

	// manipulate cards_url array
	array_push($cardsMemory, $item);
	//$card_expl = explode(array('.', '_'), $item);
	$split_img_url = preg_split('/[-_.]+/', $item);
	$img_url       = 'cards/'.$item;
	$card_obj      = $deck->setCards(new Card($cardId++, $split_img_url[0], $split_img_url[2], $img_url));
	//file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($card_obj, JSON_FORCE_OBJECT));

	// echo "<pre>";
	// print_r($split_img_url);

	// prevent duplicated items in cards array
	// if (count($cardsArr) === $countCardsLength) {
	// // save results to cards.json
	// //file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($card, JSON_FORCE_OBJECT));
	// }
}
//};
//$deck->getCards();
// echo '<pre>';

// print_r($deck->getCards());

$card_obj = $deck->getCards();

?>

<?php for ($i = 0; $i < count($card_obj); $i++):?>
  <img src="<?php echo $card_obj[$i]->getCardHref()?>" alt="">
<?php endfor;?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="css/style.css" type="text/css" rel="stylesheet" />
  <title>Swedish Rummy</title>
</head>
<body>

<?php

$card = new Card('aödsf', 123213, 'öalsdkfj');
echo $card->cardId;

?>
<header><h1>Swedish Rummy</h1></header>

<div id="wrap">

<div id="table">

<div class="row">
	<div class="player player3">
		<div class="avatar"></div>
			<div class="hand hand3">
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
			</div>
		</div>
	</div>

<div class="row middle-row">

	<div class="player player1">
	<div class="avatar"></div>
		<div class="hand">
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
		</div>
	</div>

	<div id="cardBox">
	<div id="deck"></div>
	<div id="playedCard"></div>
	</div>
	<div id="messageBox">HEJEHEJEJHEJEJEHJ</div>

	<div class="player player2">
		<div class="avatar"></div>
		<div class="hand">
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
			<div class="c"></div>
		</div>
	</div>

</div>

<div class="row">
	<div class="player player4">
		<div class="avatar"></div>
			<div class="hand">
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
				<div class="c"></div>
			</div>
	</div>
</div>

</div>

</div>

<footer></footer>

</body>
</html>
=======

// require config file
require_once 'config/config.php';
require_once 'inc/setup.php';

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
		<title>Swedish Rummy</title>
	</head>
<body>

	<header><h1>Swedish Rummy</h1></header>
		<div class="container">
			<div class="row">


				<div id="wrap">
					<div id="table">
						<div class="col-md-12 user-form">
							<form method="post">
								<input type="text" name="user">
								<input type="submit" name="submit">
							</form>
						</div><!-- end user-form -->
						<div class="col-md-12 bot-user">
						<h2>Bot user</h2>
						<?php if(filter_has_var(INPUT_POST, 'submit')): ?>
							<?php $username =   $_POST['user'];?>
							<?php $gameUsers = $deck->getUser(); ?>
							<?php foreach($gameUsers as $user): ?>
								<?php if($user->name !== $username): ?>
									<div class="bot-data">
										<p><?php echo $user->name ?></p>
											<?php
											  //drfine json file url

											  $allCards['botUser'] = ['bot' => $user->name, 'cards' => $user->getCardsArray()];
											  $allCards['invisibleCardsOnTable'] = ['cardsOnTable' => $deck->getCardOnTable()];
											  $allCards['visibleCardsOnTable'] = [];
											  file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($allCards, JSON_FORCE_OBJECT));

											?>
									</div><!-- end bot-data -->
									<div data-userId="<?php echo $user->getId(); ?>" class="cards-on-table-users bot-cards">
										<?php  for ($i=0; $i < count($user->getCardsArray()); $i++): ?>
											<div class="card-pos">

											<a href="" data-id="<?php echo $user->getCardsArray()[$i]->getCardId(); ?>"><img src="<?php echo $user->getCardsArray()[$i]->getCardHref(); ?>" alt=""></a>
											</div><!-- end card-pos -->
										<?php endfor; ?>
									</div><!-- end bot-cards -->
						</div><!-- end bot-user -->
								<?php else: ?>
									<div data-userId="<?php echo $user->getId(); ?>" class="cards-on-table-users user-cards">
									<?php $allCards['humanUser'] = ['user1' => $username, 'cards' => $user->getCardsArray()] ?>
									<?php  file_put_contents(PATH_TO_CARDS_JSON_FILE, json_encode($allCards, JSON_PRETTY_PRINT));?>
									<h3>User Cards</h3>

										<?php  for ($i=0; $i < count($user->getCardsArray()); $i++): ?>
											<div class="card-pos">

											<a href="" data-id="<?php echo $user->getCardsArray()[$i]->getCardId(); ?>"><img src="<?php echo $user->getCardsArray()[$i]->getCardHref(); ?>" alt=""></a>
											</div><!-- end card-pos -->
										<?php endfor; ?>

									</div><!-- end user-cards -->
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>

					<div class="middle-row col-md-4">

						<?php
							// $deck->setCardsOnTableBackSideUrl('img/back_of_card.png');
							$back_side = $deck->getCardOnTable();

							foreach ($back_side as $key => $value):
						?>
							<div class="cards_on_table"><a data-id="<?php echo $value->getCardId(); ?>"><img style="z-index: <?php echo $key; ?>; right: <?php echo $key / 2; ?>px" src="<?php echo $value->href ?>" alt=""></a></div>
						<?php endforeach; ?>

					</div><!-- end middle-row -->

					<footer></footer>
				</div><!-- end #table -->
				</div><!-- end wrap -->
			</div><!-- end row -->
		</div><!-- end container -->
	</body>
</html>

<?php echo '<pre>';
print_r($deck->getUser()); ?>

>>>>>>> mohamad
