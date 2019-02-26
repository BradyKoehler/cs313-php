<?php

require('shared.php');

require_logged_in();

$user_id = current_user_id($db);
$name = sanitize($_POST['name']);
$content = sanitize($_POST['content']);

$query = "INSERT INTO texts (user_id, name, content) VALUES (:user_id, :name, :content)";

$statement = $db->prepare($query);

$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':name', $name);
$statement->bindValue(':content', $content);

if ($statement->execute()) {
  $id = $db->lastInsertId("texts_id_seq");
  header("Location: view.php?id=$id");
  die();
} else {
  echo "Could not create text";
}

?>
