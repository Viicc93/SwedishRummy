<?php

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

