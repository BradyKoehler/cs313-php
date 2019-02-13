<!DOCTYPE html>
<html>

<head>
  <script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
</head>

<body>

<form id="scripture-form" action="create.php" method="post" onsubmit="return false;">
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
  <input type="checkbox" name="new_topic" />
  <input type="text" name="new_topic_name" />
  <br /><br />
  <input id="submit" type="submit" value="Submit" />
</form>

<hr />

<?php foreach ($db->query('SELECT * FROM scriptures') as $scripture): ?>
  <p><?= $scripture["book"]; ?> <?= $scripture["chapter"] ?>:<?= $scripture["verse"] ?></p>
  <p>&nbsp;&nbsp;&nbsp;<?= $scripture["content"] ?></p>
  <ul>
    <?php foreach ($db->query("select t.name from scriptures s join xrefs x on (s.id = x.scripture_id) join topics t on (x.topic_id = t.id) where s.id = " . $scripture["id"] . ";") as $topic) {
      echo "<li>" . $topic["name"] . "</li>";
    }
    ?>
  </ul>
<?php endforeach; ?>

<script type="text/javascript">

$("#submit").click(function() {
  $.post("create.php", $("#scripture-form").serialize(), function(data) {
    alert(data);
    data = JSON.parse(data);
    $('body').append(`<p>${data["scripture"]["book"]} ${data["scripture"]["chapter"]}:${data["scripture"]["verse"]}</p><p>${data["scripture"]["content"]}</p>`);
    var list = "<ul>";
    for (var i = 0; i < data["topics"].length; i++) {
      list += "<li>" + data["topics"][i]["name"] + "</li>";
    }
    list += "</ul>";
    $('body').append(list);
  });
});

</script>

</body>

</html>
