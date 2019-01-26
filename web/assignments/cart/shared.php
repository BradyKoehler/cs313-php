<?php

session_start();

if (!isset($_SESSION["items"])) {
  $_SESSION["items"] = array();
}

$items = array(
  "arduino_uno_rev3"=>array("name"=>"Arduino Uno Rev3", "price"=>"30.00"),
  "arduino_mega_2560_rev3"=>array("name"=>"Arduino Mega 2560 Rev3", "price"=>"38.50"),
  "arduino_mkr_wifi_1010"=>array("name"=>"Arduino MKR WiFi 1010", "price"=>"35.50"),
  "arduino_uno_wifi_rev2"=>array("name"=>"Arduino Uno WiFi Rev2", "price"=>"44.90"),
  "arduino_nano"=>array("name"=>"Arduino Nano", "price"=>"22.00"),
  "arduino_mkr_zero"=>array("name"=>"Arduino MKR Zero", "price"=>"21.90"),
  "arduino_mkr_gsm_1400"=>array("name"=>"Arduino MKR GSM 1400", "price"=>"69.90"),
  "arduino_mkr1000_wifi"=>array("name"=>"Arduino MKR1000 WiFi", "price"=>"34.99")
);

function countItems() {
  return count($_SESSION["items"]);
}

function getSum() {
  global $items;
  $sum = 0;

  foreach($_SESSION["items"] as $key=>$val) {
    $sum += $items[$val]["price"];
  }

  return number_format((float)$sum, 2, '.', ',');
}

function sanitize($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

function session($key) {
  return isset($_SESSION[$key]) !== false ? $_SESSION[$key] : null;
}

?>
