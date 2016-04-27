<?php

require_once '../config/config.php';
$test = file_get_contents('../txt/serialize_deck_obj.txt');
//var_dump($test);
$deck = unserialize($test);
echo json_encode($deck->getUser());
