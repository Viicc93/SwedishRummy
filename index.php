<?php
  // require config file
  require_once 'config/config.php';
  require_once 'inc/setup.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "<pre>";
print_r($card_obj);
$deck->renderDeck();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="css/style.css" type="text/css" rel="stylesheet" />
  <title>Swedish Rummy</title>
</head>
<body>

<header><h1>Swedish Rummy</h1></header>

<div id="wrap">

<div id="table">

<div class="row">
<!--	<div class="player player3">
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
		</div>-->
	</div>

<div class="row middle-row">
	<form method="post">
		<input type="text" name="user">
		<input type="submit" name="submit">
	</form>

<!--	<div class="player player1">
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
	</div>-->

</div>

<div class="row">
<!--	<div class="player player4">
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
	</div>-->
</div>

</div>

</div>

<footer></footer>

</body>
</html>

