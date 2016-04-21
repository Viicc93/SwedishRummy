<?php

session_start();

$_SESSION["playername"] = $_GET["name"];

// echo $_GET["name"];
echo '<a href="get_player_name.php">Klicka</a>';
