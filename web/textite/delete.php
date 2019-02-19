<?php

require('shared.php');

$id = sanitize($_GET['id']);
$query = "DELETE FROM texts WHERE id = :id";

$statement = $db->prepare($query);

$statement->bindValue(':id', $id);

if ($statement->execute()) {
  header("Location: index.php");
  die();
} else {
  echo "Could not delete text";
}

?>
