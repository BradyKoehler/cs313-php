<?php

require('shared.php');

?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<?php

foreach ($db->query('SELECT * FROM texts') as $note) {
  print "<a href='view.php?id=" . $note['id'] . "'><div class='note-link'><p class='name'>" . $note['name'] . "</p>";
  print "<p><span class='date'>" . $note['created_at'] . "</span>";
  print "<span class='size'>" . strlen($note['content']) . "</span></p></div></a>";
}

?>

</body>
</html>
