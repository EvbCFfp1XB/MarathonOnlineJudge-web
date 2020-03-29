<?php
session_start();

require_once('./template/init.php');

if (!isset($_GET["id"])) {
	header("Location: /");
	exit();
}
$problem_id = $_GET["id"];

if (!preg_match("/\A[a-zA-Z0-9]+\z/", $problem_id)) {
	header("Location: ./");
	exit();
}

$config_str = file_get_contents("../problems/$problem_id/config.json");
if (!$config_str) {
	header("Location: ./");
	exit();
}
$config = json_decode($config_str, true);

require_once('./template/useapi.php');

$standings = json_decode(run_cmd("get_s3_file_cache cache/$problem_id/standings.json"), true);
if (!$standings) {
	$standings = [];
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Standings</title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);

	require_once('./template/problem_header.php');
	draw_problem_header($login_state, $login_user, $problem_id);
	?>
	<div class="ats-container">
		<h1><?= $problem_id ?> Standings</h1>
		<table class="ats-table">
			<tr>
				<th>Rank</th>
				<th>User</th>
				<th>Score</th>
				<th>Submissions</th>
				<th>Best</th>
			</tr>
			<?php
			foreach ($standings as $data) {
			?>
				<tr>
					<td><?= $data['rank'] ?></td>
					<td><a href="./user.php?user=<?= $data["user"] ?>"><?= $data["user"] ?></a></td>
					<td><?= $data['score'] ?></td>
					<td><a href="./submissions.php?user=<?= $data['user'] ?>&problem=<?= $problem_id ?>">submissions</a></td>
					<td><a href="./submission.php?id=<?= $data['bestId'] ?>"><?= $data['bestId'] ?></a></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>

</body>

</html>