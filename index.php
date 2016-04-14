<?php require_once 'config/config.php' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href= "css/style.css" type="text/css" rel="stylesheet" />
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
