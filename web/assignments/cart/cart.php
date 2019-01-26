<?php include 'shared.php'; ?>

<!DOCTYPE html>
<html>
<?php require('html/head.html'); ?>
<body>

  <div class="sidebar">
    <h1 class="header">Electro Mart</h1>

    <a href="index.php">
      <button class="default">Continue Browsing</button>
    </a>

    <a href="checkout.php">
      <button class="primary">Continue to Checkout</button>
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
        <button class="remove" data-item="<?= $val ?>">Remove</button>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="right">
      <h2 class="header">Total Items: <span id="itemCount"><?= countItems(); ?></span></h2>
      <h2 class="header">Total Cost: <span id="totalCost"><?= getSum(); ?></span></h2>
    </div>
  </div>

  <?php require('html/disclaimer.html'); ?>

  <script type="text/javascript" src="js/remove.js"></script>

</body>
</html>
