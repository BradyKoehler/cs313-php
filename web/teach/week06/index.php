<!DOCTYPE html>
<html>

<body>

<form action="create.php" method="post">
  <label for="book">Book</label>
  <input type="text" name="book" id="book" />
  <br />
  <label for="chapter">Chapter</label>
  <input type="number" name="chapter" id="chapter" />
  <br />
  <label for="verse">Verse</label>
  <input type="number" name="verse" id="verse" />
  <br />
  <label for="content">Content</label><br />
  <textarea id="content" name="content"></textarea>
  <br /><br />
  <?php
  $dbUrl = getenv('DATABASE_URL');

  $dbopts = parse_url($dbUrl);


  $dbHost = $dbopts["host"];
  $dbPort = $dbopts["port"];
  $dbUser = $dbopts["user"];
  $dbPassword = $dbopts["pass"];
  $dbName = ltrim($dbopts["path"],'/');


  try {
   $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  }
  catch (PDOException $ex) {
   print "<p>error: $ex </p>\n\n";
   die();
  }

  foreach ($db->query('SELECT * FROM topics') as $topic) {
    echo "<input type='checkbox' name='topic[]' value='" . $topic["id"] . "' /> " . $topic["name"] . "<br />";
  }
  ?>
  <br /><br />
  <input type="submit" value="Submit" />
</form>

</body>

</html>
