<?php

require('shared.php');
// try
// {
//   $dbUrl = getenv('DATABASE_URL');
//
//   $dbOpts = parse_url($dbUrl);
//
//   $dbHost = $dbOpts["host"];
//   $dbPort = $dbOpts["port"];
//   $dbUser = $dbOpts["user"];
//   $dbPassword = $dbOpts["pass"];
//   $dbName = ltrim($dbOpts["path"],'/');
//
//   $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
//
//   $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch (PDOException $ex)
// {
//   echo 'Error!: ' . $ex->getMessage();
//   die();
// }

?>

<!DOCTYPE html>
<html>
<?php require('head.php'); ?>
<body>

<?php require('header.php'); ?>

<div class="note-link">
  <p class="name">Note 1</p>
  <p>
    <span class="date">January 1, 2019</span>
    <span class="size">150kb</span>
  </p>
</div>

<div class="note-link">
  <p class="name">Note 2</p>
  <p>
    <span class="date">January 2, 2019</span>
    <span class="size">250kb</span>
  </p>
</div>

<div class="note-link">
  <p class="name">Note 3</p>
  <p>
    <span class="date">January 3, 2019</span>
    <span class="size">350kb</span>
  </p>
</div>

<div class="note-link">
  <p class="name">Note 4</p>
  <p>
    <span class="date">January 4, 2019</span>
    <span class="size">450kb</span>
  </p>
</div>

<div class="note-link">
  <p class="name">Note 5</p>
  <p>
    <span class="date">January 5, 2019</span>
    <span class="size">550kb</span>
  </p>
</div>

</body>
</html>
