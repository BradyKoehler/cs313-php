<?php

include 'shared.php';

$item = sanitize($_POST["item"]);

if (($key = array_search($item, $_SESSION["items"])) !== false) {
  unset($_SESSION["items"][$key]);
}

$res = new stdClass();
$res->count = countItems();
$res->price = getSum();

echo json_encode($res);

?>
