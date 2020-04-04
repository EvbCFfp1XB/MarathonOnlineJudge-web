<?php
session_start();

require_once('./template/init.php');
require_once('./template/useapi.php');

require_once('./template/submission_table.php');
if(!isset($_POST["sub_id"])){
	exit();
}
$sub_id = $_POST["sub_id"];
if (!preg_match("/\A[a-zA-Z0-9]+\z/", $sub_id)) {
	header("Location: ./");
	exit();
}
append_submission_result(null, $sub_id);