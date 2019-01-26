<?php

include 'shared.php';

$_SESSION["address_one"] = sanitize($_POST["address_one"]);
$_SESSION["address_two"] = sanitize($_POST["address_two"]);
$_SESSION["city"]        = sanitize($_POST["city"]);
$_SESSION["state"]       = sanitize($_POST["state"]);
$_SESSION["zipcode"]     = sanitize($_POST["zipcode"]);

?>

<!DOCTYPE html>
<html>
<?php require('html/head.html'); ?>
<body>

  <div class="sidebar">
    <h1 class="header">Electro Mart</h1>

    <a href="checkout.php">
      <button class="default">Edit Shipping Info</button>
    </a>

    <div class="disclaimer">
      <button class="default">Disclaimer</button>
    </div>
  </div>

  <div class="main">
    <div class="left">
      <h2 class="header">Your Cart</h2>
      <?php foreach($_SESSION["items"] as $key=>$val): ?>
      <div class="list-item">
        <img src="img/<?= $val ?>.jpg" />
        <p>
          <b><?= $items[$val]["name"] ?></b>
          <span class="price"><?= $items[$val]["price"] ?></span>
        </p>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="right">
      <h2 class="header">Shipping Information</h2>
      <div class="shipping">
        <hr /><br />
        <p>
          <?= $_SESSION["address_one"]; ?><br />
          <?= $_SESSION["address_two"] != "" ? $_SESSION["address_two"] . "<br />" : ""; ?>
          <?= $_SESSION["city"]; ?>, <?= $_SESSION["state"]; ?> <?= $_SESSION["zipcode"]; ?>
        </p>
        <br /><hr /><br />
      </div>
      <h2 class="header float">Total Items: <span id="itemCount"><?= countItems(); ?></span></h2>
      <h2 class="header float">Total Cost: <span id="totalCost"><?= getSum(); ?></span></h2>
      <h2 class="header float thanks"><i>Thank you for your purchase!</i></h2>
    </div>
  </div>

  <?php require('html/disclaimer.html'); ?>

</body>
</html>
