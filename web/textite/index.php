<?php require('shared.php'); ?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<div class='container'>

<?php

foreach ($db->query('SELECT * FROM texts') as $text) {
  print "<a href='view.php?id=" . $text['id'] . "'><div class='note-link'><p class='name'>" . $text['name'] . "</p>";
  print "<p><span class='date'>" . $text['created_at'] . "</span>";
  print "<span class='size'>" . strlen($text['content']) . "</span></p></div></a>";
}

?>

</div>

</body>
</html>
