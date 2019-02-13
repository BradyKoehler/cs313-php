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

function sanitize($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

$db->query("INSERT INTO scriptures (book, chapter, verse, content) VALUES (" .
           sanitize($_POST['book']) . ", " .
           sanitize($_POST['chapter']) . ", " .
           sanitize($_POST['verse']) . ", " .
           sanitize($_POST['content']) . ")"
          );


?>

<!DOCTYPE html>
<html>

<body>


<?php foreach ($db->query('SELECT * FROM scriptures') as $scripture): ?>
  <p><?= $scripture["name"]; ?></p>
  <ul>
    <?php foreach ($db->query('SELECT t.id, t.name FROM scriptures s ' .
                              'JOIN xrefs x on (s.id = x.scripture_id) JOIN topics t on (x.topic_id = t.id)') as $topic): ?>
    <li><?= $topic["name"]; ?></li>
    <?php endforeach; ?>
  </ul>
<?php endforeach; ?>

</body>

</html>
