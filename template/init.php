<?php
session_start();
$login_user = null;
$login_state = false;
if (isset($_SESSION["username"])) {
	$login_user = $_SESSION["username"];
	$login_state = true;
}
unset($_SESSION["before"]);
if (isset($_SESSION["current"])) $_SESSION["before"] = $_SESSION["current"];
$_SESSION["current"] = $_SERVER['REQUEST_URI'];
$url_before = "./index.php";
if (isset($_SESSION["before"])) $url_before = $_SESSION["before"];
