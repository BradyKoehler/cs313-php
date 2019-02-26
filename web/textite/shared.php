<?php

function startSession() {
  session_start();
  $_SESSION['started'] = true;
}

if (!isset($_SESSION['started'])) {
  startSession();
}

$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 $dbUrl = "postgres://postgres:T3l3m3+ry@localhost:5432/textite";
}

$dbopts = parse_url($dbUrl);

$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try {
  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName;user=$dbUser;password=$dbPassword");
}
catch (PDOException $ex) {
 print "<p>error: $ex </p>\n\n";
 die();
}

function sanitize($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}

function logged_in() {
  return isset($_SESSION['user']);
}

function require_logged_in() {
  if (!logged_in()) {
    header("Location: /textite/sessions/new.php");
    die();
  }
}

function current_user_id($db_instance) {
  if (!logged_in()) {
    return nil;
  } else {
    $user = $db_instance->query("SELECT id FROM users WHERE username = '" . $_SESSION['user'] . "'")->fetch();
    return $user['id'];
  }
}

?>
