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

var_dump($_POST);

$query = "INSERT INTO scriptures (book, chapter, verse, content) VALUES ('" . $_POST['book'] . "', '" .
           sanitize($_POST['chapter']) . "', '" .
           sanitize($_POST['verse']) . "', '" .
           sanitize($_POST['content']) . "') RETURNING id";
// var_dump($query);
$db->query($query);
$scripture_id = $db->lastInsertId();
var_dump($scripture_id);

// $db->query("INSERT INTO xrefs (scripture_id, topic_id) VALUES(" . $scripture_id . ", ". $_POST['topic'] .")");

foreach ($_POST['topic'] as $topic) {
  $db->query("INSERT INTO xrefs (scripture_id, topic_id) VALUES( " . $scripture_id . ", $topic)");
}

if (isset($_POST["new_topic"])) {
  $db->query("INSERT INTO topics (name) VALUES ('" . $_POST["new_topic_name"] . "')");
  $topic_id = $db->lastInsertId();
  $db->query("INSERT INTO xrefs (scripture_id, topic_id) VALUES($scripture_id, $topic_id)");
}

header('Location: index.php');
die();
?>

<!DOCTYPE html>
<html>

<body>


<?php foreach ($db->query('SELECT * FROM scriptures') as $scripture): ?>
  <p><?= $scripture["book"]; ?> <?= $scripture["chapter"] ?>:<?= $scripture["verse"] ?></p>
  <p>&nbsp;&nbsp;&nbsp;<?= $scripture["content"] ?></p>
  <ul>
    <?php foreach ($db->query("select t.id as tid, t.name from scriptures s join xrefs x on (s.id = x.scripture_id) join topics t on (x.topic_id = t.id) where s.id = " . $scripture["id"] . ";") as $topic) {
      echo "<li>" . $topic["name"] . "</li>";
    }
    ?>
  </ul>
<?php endforeach; ?>

</body>

</html>
