<?php
require('../shared.php');

if (!logged_in()) {
  header('Location: /textite/index.php');
  die();
} else {
  $_SESSION = array();
  session_destroy();
  header('Location: new.php');
}
?>
