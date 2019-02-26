<?php
require('../shared.php');
?>

<!DOCTYPE html>
<html>
<?php require('../head.php'); ?>
<body>

<?php require('../header.php'); ?>

<?php
$result = $db->query('SELECT * FROM users WHERE id=' . $_GET['id']);
$user = $result->fetch(PDO::FETCH_ASSOC);
?>
<div class='container'>

<h3><?= $user['username']; ?></h3>

<?php

foreach ($db->query('SELECT * FROM texts WHERE user_id = ' . $user['id']) as $text) {
  print "<a href='../view.php?id=" . $text['id'] . "'><div class='note-link'><p class='name'>";
  print $text['name'] . "<span class='right'>Views: " . $text['views'] . "</span></p>";
  print "<p><span class='date'>" . $text['created_at'] . "</span>";
  print "<span class='size'>" . strlen($text['content']) . "</span></p></div></a>";
}

?>

</div>

</body>
</html>
