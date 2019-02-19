<?php require('shared.php'); ?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<div class="container">
  <div class="text-new">
    <form action="create.php" method="post">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" />
      <br /><br />

      <textarea id="content" name="content" rows="40" placeholder="Type your note here..."></textarea>

      <br /><br />
      <input type="submit" value="Submit" />
    </form>
  </div>
</div>

</body>
</html>
