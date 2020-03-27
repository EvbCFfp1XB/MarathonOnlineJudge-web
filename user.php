<?php
session_start();

require_once('./template/init.php');

if (!isset($_GET["user"])) {
	header("Location: ./");
	exit();
}

$user = $_GET["user"];

if (!preg_match("/\A[a-zA-Z0-9]+\z/", $user)) {
	header("Location: ./");
	exit();
}


require_once('./template/useapi.php');

$ranks_str = run_cmd("get_s3_file_cache user/$user/ranks.json");
$ranks = null;
if (!empty($ranks_str)) {
	$ranks = json_decode($ranks_str, true);
}


?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>User: <?= $user ?></title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>User: <?= $user ?></h1>
		<a href="./submissions.php?user=<?= $user ?>">All Submissions</a>
	</div>
	<div class="ats-container">
		<h2>Achivements</h2>
		<table class="ats-table">
			<tr>
				<th>problem</th>
				<th>Rank</th>
				<th>Score</th>
				<th>Submissions</th>
				<th>Best</th>
			</tr>
			<?php
			foreach ($ranks as $prob => $data) {
			?>
				<tr>
					<td><a href="./problem.php?id=<?= $prob ?>"><?= $prob ?></a></td>
					<td><?= $data['rank'] ?></td>
					<td><?= $data['score'] ?></td>
					<td><a href="./submissions.php?user=<?= $data['user'] ?>&problem=<?= $prob ?>">submissions</a></td>
					<td><a href="./submission.php?id=<?= $data['bestId'] ?>"><?= $data['bestId'] ?></a></td>
				</tr>
			<?php
			}
			?>
		</table>
		<div style="margin-bottom: 200px"></div>
	</div>
</body>

</html>