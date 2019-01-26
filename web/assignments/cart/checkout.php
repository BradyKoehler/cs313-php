<?php include 'shared.php'; ?>

<!DOCTYPE html>
<html>
<?php require('html/head.html'); ?>
<body>

  <div class="sidebar">
    <h1 class="header">Electro Mart</h1>

    <a href="cart.php">
      <button class="default">Return to Cart</button>
    </a>

    <button id="purchase" class="primary">Complete Purchase</button>

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
        <form id="shipping" action="complete.php" method="post">
          <label for="address_one">Street Address</label>
          <input id="address_one" name="address_one" type="text" value="<?= session("address_one"); ?>" />
          <input id="address_two" name="address_two" type="text" value="<?= session("address_two"); ?>" />

          <label for="city">City</label>
          <input id="city" name="city" type="text" value="<?= session("city"); ?>" />

          <label for="state">State</label>
          <input id="state" name="state" type="text" value="<?= session("state"); ?>" />

          <label for="zipcode">Zipcode</label>
          <input id="zipcode" name="zipcode" type="text" value="<?= session("zipcode"); ?>" />
        </form>
        <br />
        <hr />
      </div>
      <h2 class="header half">Total Items: <span id="itemCount"><?= countItems(); ?></span></h2>
      <h2 class="header half">Total Cost: <span id="totalCost"><?= getSum(); ?></span></h2>
    </div>
  </div>

  <?php require('html/disclaimer.html'); ?>

  <script type="text/javascript" src="js/checkout.js"></script>

</body>
</html>
