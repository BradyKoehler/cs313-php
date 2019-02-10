<?php
require('shared.php');
?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<?php
$result = $db->query('SELECT * FROM texts WHERE id=1');
$text = $result->fetch(PDO::FETCH_ASSOC);
?>

<div class="note-view">
  <p class="name"><?= $text['note']; ?></p>
  <p>
    <span class="date"><?= $text['created_at']; ?></span>
    <span class="size"><?= strlen($text['content']); ?></span>
  </p>
  <pre>
    <?= $text['content']; ?>
  </pre>
</div>

</body>
</html>
