<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8"/>
	<link rel="stylesheet" href="css/style.css">
	<title>Swedish Rummy</title>
</head>

<body>
	<?php

	spl_autoload_register( function($className)
	{
		include "classes/" . $className . ".class.php";
	});

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


