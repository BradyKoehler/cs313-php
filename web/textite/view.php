<?php
require('shared.php');
?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<?php
$result = $db->query('SELECT t.id, t.created_at, t.name, t.content, t.views, t.user_id, u.username FROM texts t JOIN users u ON t.user_id = u.id WHERE t.id=' . $_GET['id']);
$text = $result->fetch(PDO::FETCH_ASSOC);
$statement = $db->prepare("UPDATE texts SET views = views + 1 WHERE id = :id");
$statement->bindValue(":id", $text['id']);
$statement->execute();
?>
<div class='container'>

<div class="note-view" data-id="<?= $text['id'] ?>">
  <p class="name">
    <?= $text['name']; ?>
    <span style="float: right;">Views: <?= $text['views'] + 1 ?></span>
  </p>
  <p><em><?= $text['username'] ?></em></p>
  <p>
    <span class="date"><?= $text['created_at']; ?></span>
    <span class="size"><?= strlen($text['content']); ?></span>
  </p>
  <pre>
    <?= $text['content']; ?>
  </pre>
  <a href="edit.php?id=<?= $text['id']; ?>"><button class="edit">Edit</button></a>
  <a href="delete.php?id=<?= $text['id']; ?>" style="float: right;"><button class="delete">Delete</button></a>
</div>

<div class="text-notes">
  <?php if (logged_in()) : ?>
  <div class="note note-new">
    <textarea id="note-new"></textarea>
    <button id="new-note">Save</button>
  </div>
  <?php endif ?>
  <?php foreach($db->query('SELECT n.id, n.created_at, n.content, u.id as user_id, u.username FROM notes n JOIN users u ON n.user_id = u.id WHERE n.text_id = ' . $text['id'] . ' ORDER BY n.created_at DESC') as $note) : ?>
  <div class="note">
    <p>
      <a href="users/view.php?id=<?= $note['user_id'] ?>"><?= $note['username'] ?></a>
      <span style="float: right;"><?= $note['created_at'] ?></span>
    </p>
    <p><?= $note['content'] ?></p>
  </div>
  <?php endforeach ?>
</div>

</div>

<script type="text/javascript" src="notes.js"></script>

</body>
</html>
