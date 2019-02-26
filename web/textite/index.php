<?php require('shared.php'); ?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<div class='container'>

<?php

foreach ($db->query('SELECT * FROM texts ORDER BY created_at DESC') as $text) {
  print "<a href='view.php?id=" . $text['id'] . "'><div class='note-link'><p class='name'>";
  print $text['name'] . "<span class='right'>Views: " . $text['views'] . "</span></p>";
  print "<p><span class='date'>" . $text['created_at'] . "</span>";
  print "<span class='size'>" . strlen($text['content']) . "</span></p></div></a>";
}

?>

</div>

</body>
</html>
