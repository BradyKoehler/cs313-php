<?php
require('../shared.php');
?>

<!DOCTYPE html>
<html>
<?php require('../head.php'); ?>
<body>

<?php require('../header.php'); ?>

<div class='container'>

<ul>
  <?php

  foreach($db->query('SELECT * FROM users') as $user) :
  ?>
  <li>
    <a href="view.php?id=<?= $user['id'] ?>"><?= $user['username'] ?></a>
  </li>
  <?php endforeach ?>
</ul>

</div>

</body>
</html>
