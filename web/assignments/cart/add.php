<?php

include 'shared.php';

$item = sanitize($_POST["item"]);

if (($key = array_search($item, $_SESSION["items"])) !== false) {
  header('HTTP/1.0 409 Conflict');
  exit("Item already in cart");
}

$_SESSION["items"][] = $item;

if (isset($_POST["undo"]) && sanitize($_POST["undo"])) {
  $res = new stdClass();
  $res->name = $items[$item]["name"];
  $res->price = $items[$item]["price"];
  $res->count = countItems();
  $res->sum = getSum();
  echo json_encode($res);
} else {
  echo countItems();
}

?>
