<?php include 'shared.php'; ?>

<!DOCTYPE html>
<html>
<?php require('html/head.html'); ?>
<body>

  <div class="sidebar">
    <h1 class="header">Electro Mart</h1>

    <a href="cart.php">
      <button class="primary">
        View Cart <span id="itemCount">(<?= countItems(); ?>)</span>
      </button>
    </a>

    <div class="disclaimer">
      <button class="default">Disclaimer</button>
    </div>
  </div>

  <div class="main">

    <?php foreach($items as $key=>$val): ?>
    <div class="item"<?= array_search($key, $_SESSION["items"]) !== false ? ' data-status="in-cart"' : ''; ?>>
      <img src="img/<?= $key ?>.jpg" />
      <p>
        <b><?= $val["name"] ?></b>
        <span class="price"><?= $val["price"] ?></span>
      </p>
      <button class="add" data-item="<?= $key ?>">Add to Cart</button>
      <button class="in-cart">In Cart</button>
    </div>
    <?php endforeach; ?>

  </div>

  <?php require('html/disclaimer.html'); ?>

  <script type="text/javascript" src="js/add.js"></script>

</body>
</html>
