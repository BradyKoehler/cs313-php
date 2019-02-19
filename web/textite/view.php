<?php
require('shared.php');
?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<?php
$result = $db->query('SELECT * FROM texts WHERE id=' . $_GET['id']);
$text = $result->fetch(PDO::FETCH_ASSOC);
?>
<div class='container'>

<div class="note-view">
  <p class="name"><?= $text['name']; ?></p>
  <p>
    <span class="date"><?= $text['created_at']; ?></span>
    <span class="size"><?= strlen($text['content']); ?></span>
  </p>
  <pre>
    <?= $text['content']; ?>
  </pre>
  <a href="edit.php?id=<?= $text['id']; ?>"><button class="edit">Edit</button></a>
  <a href="delete.php?id=<?= $text['id']; ?>"><button class="delete">Delete</button></a>
</div>

</div>

</body>
</html>
