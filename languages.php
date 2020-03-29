<?php
session_start();

require_once('./template/init.php');

$langs_str = file_get_contents("../judge/lang/langs.json");
if (!$langs_str) {
	header("Location: /");
	exit();
}
$langs = json_decode($langs_str, true);
ksort($langs)

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Languages</title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	require_once('./template/info_header.php');
	draw_info_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Languages</h1>
		<table class="ats-table">
			<tr>
				<th>ID</th>
				<th>Compile</th>
				<th>Run</th>
			</tr>
			<?php
			foreach ($langs as $name => $data) {
			?>
				<tr>
					<td><?= $name ?></td>
					<td><?= $data['compile'] ?></td>
					<td><?= $data['run'] ?></td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>

	<div class="ats-container">
		<p>基本的に言語のバージョンは Amazon Linux 2 にデフォルトでインストールされるものです。</p>
		<p>python3では、numpyとscipyがたぶん使えます。</p>
		<p>javaの提出は、クラス名Mainで宣言してください</p>
		<p>インストールのコマンド等は<a href="https://github.com/ats5515/MarathonOnlineJudge-judge/tree/master/judge/lang">こちら</a>を参照してください。
		</p>
	</div>

	<div style="margin-bottom: 200px"></div>
</body>

</html>