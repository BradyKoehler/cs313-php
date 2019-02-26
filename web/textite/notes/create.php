<?php
require('../shared.php');

require_logged_in();

$username = $_SESSION["user"];
$text_id = sanitize($_POST['id']);
$content = sanitize($_POST['content']);

$query = "INSERT INTO notes (user_id, text_id, content) VALUES ((
  SELECT id FROM users WHERE username = :username
), :text_id, :content)";

$statement = $db->prepare($query);

$statement->bindValue(":username", $username);
$statement->bindValue(":text_id", $text_id);
$statement->bindValue(":content", $content);

if ($statement->execute()) {
  $note_id = $db->lastInsertId('notes_id_seq');
  $query = "SELECT user_id, content, created_at FROM notes WHERE id = :note_id LIMIT 1";
  $statement = $db->prepare($query);
  $statement->bindValue(":note_id", $note_id);
  $statement->execute();
  $note = $statement->fetch();

  $data = new stdClass();
  $data->user_id = $note['user_id'];
  $data->content = $note['content'];
  $data->username = $username;
  $data->created_at = $note['created_at'];

  echo json_encode($data);
} else {
  echo "Could not create note";
}

die();

foreach ($_POST['topic'] as $topic) {
  $db->query("INSERT INTO xrefs (scripture_id, topic_id) VALUES( " . $scripture_id . ", $topic)");
}

if (isset($_POST["new_topic"])) {
  $db->query("INSERT INTO topics (name) VALUES ('" . $_POST["new_topic_name"] . "')");
  $topic_id = $db->lastInsertId();
  $db->query("INSERT INTO xrefs (scripture_id, topic_id) VALUES($scripture_id, $topic_id)");
}

$data->scripture = $db->query("SELECT * FROM scriptures WHERE id = $scripture_id")->fetch(PDO::FETCH_ASSOC);
$query2 = $db->prepare("SELECT t.id AS tid, t.name FROM scriptures s JOIN xrefs x ON (s.id = x.scripture_id) JOIN topics t ON (x.topic_id = t.id) WHERE s.id = " . $scripture_id . ";");
$query2->execute();
$results = $query2->fetchAll(PDO::FETCH_ASSOC);
$data->topics = $results;

echo json_encode($data);
die();
?>
