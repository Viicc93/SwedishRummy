<?php
require_once '../config/config.php';
$test = file_get_contents('../txt/serialize_deck_obj.txt');
$deck = unserialize($test);// unserialize deck obj from file
echo json_encode($deck->getUser());// echo all user object
