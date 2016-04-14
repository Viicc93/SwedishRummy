<?php require_once 'config/config.php' ?>
<?php

$json_file = 'json/cards.json';
$cardsMemory = [];
$countCardsLength = 0;
  if (!file_exists($json_file, 'w+')) {
    $fp = fopen($json_file, 'w+');
    fclose($fp);

    $cardsArr = scandir('cards');

    foreach ($cardsArr as $item) {
        $countCardsLength++;
      if ($item == '..' || $item == '.' || $item == '.DS_Store') continue;

        $card_url = array_push($cardsMemory, $item);
      //echo $item . '<br>';
      if (count($cardsArr) === $countCardsLength) {
      //   $cardsMemory = $cardsArr;
        file_put_contents($json_file, json_encode($cardsMemory, JSON_FORCE_OBJECT));
      // echo "<pre>";
        echo "<pre>";
      print_r($cardsMemory);

      }

    }
    // if (strpos(haystack, needle)) {
    //   # code...
    // }
    // echo "<pre>";
    // print_r($cardsArr);
  };

$cardMemory = [];

$card = new Card('aödsf', 123213, 'öalsdkfj');
echo $card->cardId;


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="css/style.css" type="text/css" rel="stylesheet" />
  <title>Swedish Rummy</title>
</head>
<body>

</body>
</html>

