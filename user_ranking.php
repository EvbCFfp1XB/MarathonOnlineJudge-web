<?php
session_start();

require_once('./template/init.php');
require_once('./template/useapi.php');

$ranking = run_cmd("get_s3_file data/user_ranking.json");
$ranking = json_decode($ranking, true);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>User Ranking</title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>User Ranking</h1>
		<table class="ats-table">
			<tr>
				<th>Rank</th>
				<th>User</th>
				<th>Score</th>
			</tr>
			<?php
			foreach ($ranking as $data) {
			?>
				<tr>
					<td><?= $data['rank'] ?></td>
					<td><a href="./user.php?user=<?= $data["user"] ?>"><?= $data["user"] ?></a></td>
					<td><?= $data['score'] ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</body>

</html>