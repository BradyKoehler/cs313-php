<div class="header">
  <a href="/textite/index.php"><h1>Textite</h1></a>
  <?php if (logged_in()) { ?>
    <a href="/textite/sessions/destroy.php" class="new"><p>Log out</p></a>
    <a href="/textite/new.php" class="new"><p>New Text</p></a>
  <?php } else { ?>
    <a href="/textite/sessions/new.php" class="new"><p>Log in</p></a>
    <a href="/textite/users/new.php" class="new"><p>Sign up</p></a>
  <?php } ?>

</div>
