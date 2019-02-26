<?php
require('../shared.php');

if (isset($_SESSION['user'])) {
  header('Location: /textite/index.php');
  die();
}

if (isset($_POST['password']) AND isset($_POST['password_confirmation']) AND isset($_POST['username']) AND isset($_POST['email'])) {
  $username = sanitize($_POST['username']);
  $email = sanitize($_POST['email']);
  $password = sanitize($_POST['password']);
  $password_confirmation = sanitize($_POST['password_confirmation']);

  if ($password == $password_confirmation) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $statement = $db->prepare($query);

    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hash);

    if ($statement->execute()) {
      header('Location: /textite/sessions/new.php ');
      die();
    } else {
      echo "Could not create account.";
    }
  } else {
    // password and confirmation do not match
  }
}
?>

<!DOCTYPE html>
<html>
<?php require('../head.php'); ?>
<body>

<?php require('../header.php'); ?>

<div class='container'>

<form class="block" action="new.php" method="post">
  <label for="username">Username</label>
  <input type="text" name="username" id="username" required />
  <br /><br />

  <label for="email">Email</label>
  <input type="text" name="email" id="email" required />
  <br /><br />

  <label for="password">Password</label>
  <input type="password" name="password" id="password" required />
  <br /><br />

  <label for="password_confirmation">Confirm Password</label>
  <input type="password" name="password_confirmation" id="password_confirmation" required />
  <br /><br />

  <input type="submit" value="Sign up" />
</form>

</div>

</body>
</html>
