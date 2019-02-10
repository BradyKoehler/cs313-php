<?php require('shared.php'); ?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<div class="login">
  <form action="login.php" method="post">
    <h3>Login</h3>
    <br />
    <label for="username">Username</label><br />
    <input type="text" id="username" name="username" />
    <br /><br />
    <label for="password">Password</label><br />
    <input type="password" id="password" name="password" />
    <br /><br />
    <input type="submit" value="Submit" />
  </form>
</div>

</body>
</html>
