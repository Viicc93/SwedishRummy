<?php require_once 'config/config.php' ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="#" type="text/css" rel="stylesheet" />
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

<div class="player player1"></div>

<div id="deck"></div>
<div id="playedCard"></div>
<div id="messageBox"></div>

<div class="player player2"></div>




</div>









</div>

<footer></footer>

</body>
</html>
