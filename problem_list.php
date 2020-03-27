<?php
session_start();

require_once('./template/init.php');

$problems_str = file_get_contents("../problems/problems.json");
if (!$problems_str) {
	header("Location: /");
	exit();
}
$problems = json_decode($problems_str, true);

require_once('./template/useapi.php');
$ranks = json_encode("{}");

if($login_state){
	$ranks = json_decode(run_cmd("get_s3_file_cache user/$login_user/ranks.json"), true);
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title> Problems </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Problem List</h1>
		<table class="ats-table">
			<?php
			require_once('./template/problems_table.php');
			append_problems_header();
			foreach ($problems as $ID => $config) {
				append_problem_config($ID, $config, $ranks);
			}
			?>
		</table>
	</div>

</body>

</html>