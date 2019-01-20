<?php
$file = "messages/" . time() . "_" . $_POST["name"] . ".txt";
$msg = fopen($file, "w") or die("Unable to save message.");

fwrite($msg, $_POST["name"] . "\n" . $_POST["message"]);
fclose($msg);
?>

<!DOCTYPE html>
<html>
<head>

  <title>Brady Koehler</title>
  <link rel="stylesheet" href="/styles/main.css" type="text/css" />

</head>
<body>

  <div class="coming-soon">
    <h1>Thank you, <?php echo $_POST["name"]; ?>.<br /><small>Your message has been received.</small></h1>

    <p><a class="underline" href="/">Click here to go back to the main page</a></p>
  </div>

</body>
</html>
