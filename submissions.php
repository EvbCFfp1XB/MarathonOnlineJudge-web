<?php
session_start();

require_once('./template/init.php');
require_once('./template/useapi.php');

$data_json = null;
$problem = null;
$user = null;
$page = 0;
if (isset($_GET["problem"]) && isset($_GET["user"])) {
	$problem = $_GET["problem"];
	$user = $_GET["user"];

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $problem)) {
		header("Location: ./");
		exit();
	}

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $user)) {
		header("Location: ./");
		exit();
	}

	$result_str = run_cmd("get_s3_file_dircache cache/$problem/$user/pu_result.json");
	if (!empty($result_str)) {
		$data_json  = array_reverse(json_decode($result_str, true), true);
	}
} else if (isset($_GET["user"])) {
	$user = $_GET["user"];

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $user)) {
		header("Location: ./");
		exit();
	}

	$result_str = run_cmd("get_s3_file_dircache user/$user/u_result.json");
	if (!empty($result_str)) {
		$data_json  = array_reverse(json_decode($result_str, true), true);
	}
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Submissions </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	if ($problem) {
		require_once('./template/problem_header.php');
		draw_problem_header($login_state, $login_user, $problem, null);
	}
	//var_dump($data_json);
	//exit();
	?>
	<div class="ats-container">
		<h1>Submissions <span style="font-size: 50%">
	<?php
	if($problem){
		echo "problem: $problem, ";
	}
	if($user){
		echo "user: $user, ";
	}
	?>
	</span></h1>

		<table class="ats-table">
			<?php
			require_once('./template/submission_table.php');
			append_header();
			foreach ($data_json as $submission_id => $result) {
				append_submission_result($result, $submission_id);
			}
			?>
		</table>
	</div>
</body>

</html>