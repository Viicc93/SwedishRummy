<?php
<<<<<<< HEAD
// require_once '../config/config.php';
// $test = file_get_contents('../txt/serialize_obj.txt');
// //var_dump($test);
// $deck = unserialize($test);
// echo json_encode($deck->getCards());
=======
require_once '../config/config.php';

$test = file_get_contents('../txt/serialize_deck_obj.txt');
$deck = unserialize($test); // unserialize deck obj from file

echo json_encode($deck->getUser()); // echo all user object

>>>>>>> master
