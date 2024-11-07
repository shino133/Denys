<?php
if (isset($_SESSION["username"])) {
  header("Location: feed.php");
  exit;
}