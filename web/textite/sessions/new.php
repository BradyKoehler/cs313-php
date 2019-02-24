<?php
require('../shared.php');

if (isset($_SESSION['user'])) {
  header('Location: /textite/index.php');
  die();
}

if (isset($_POST['email']) AND isset($_POST['password'])) {
  $email = sanitize($_POST['email']);
  $password = sanitize($_POST['password']);

  $query = "SELECT email, username, password FROM users WHERE email = :email";

  $statement = $db->prepare($query);

  $statement->bindValue(':email', $email);

  if ($statement->execute()) {
    $user = $statement->fetch();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header('Location: /textite/index.php');
        die();
    } else {
      echo 'Password incorrect';
    }
  } else {
    echo "Could not find user";
  }
}
?>

<!DOCTYPE html>
<html>
<?php require('../head.php'); ?>
<body>

<?php require('../header.php'); ?>

<div class='container'>

<form action="new.php" method="post">
  <label for="email">Email:</label>
  <input type="text" name="email" id="email" required />
  <br /><br />

  <label for="password">Password:</label>
  <input type="password" name="password" id="password" required />
  <br /><br />

  <input type="submit" value="Log in" />
</form>

</div>

</body>
</html>
