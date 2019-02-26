<?php

require('shared.php');

$id = sanitize($_GET['id']);

$query = "SELECT * FROM texts WHERE id = :id";

$statement = $db->prepare($query);

$statement->bindValue(':id', $id);

if ($statement->execute()) {
  if ($statement->rowCount() == 1) {
    $text = $statement->fetch();
  } else {
    echo "Could not find text";
    die();
  }
} else {
  echo "Could not edit text";
  die();
}

?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<div class="container">
  <div class="text-new">
    <form action="update.php" method="post">
      <input type="hidden" name="id" value="<?= $text['id']; ?>" />
      <label for="name">Name</label>
      <input type="text" id="name" name="name" value="<?= $text['name']; ?>" />
      <br /><br />

      <textarea id="content" name="content" rows="40" placeholder="Type your note here..."><?= $text['content']; ?></textarea>

      <br /><br />
      <input type="submit" value="Submit" />
    </form>
  </div>
</div>

</body>
</html>
