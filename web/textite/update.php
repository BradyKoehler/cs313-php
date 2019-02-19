<?php

require('shared.php');

$id = sanitize($_POST['id']);

$query = "SELECT * FROM texts WHERE id = :id";

$statement = $db->prepare($query);

$statement->bindValue(':id', $id);

if ($statement->execute()) {
  // ensure text exists
  if ($statement->rowCount() == 1) {
    $query = "UPDATE texts SET name = :name, content = :content WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);

    $name = sanitize($_POST['name']);
    $content = sanitize($_POST['content']);

    $statement->bindValue(':name', $name);
    $statement->bindValue(':content', $content);

    if ($statement->execute()) {
      header("Location: view.php?id=$id");
      die();
    } else {
      echo "Could not update text";
      die();
    }
  } else {
    echo "Could not update text";
    die();
  }
} else {
  echo "Could not update text";
  die();
}

?>
