<?php
session_start();
require_once('./template/init.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Judge Server</title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	require_once('./template/info_header.php');
	draw_info_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Judge Server</h1>
		<p>AWS上で動かしています。ジャッジサーバのイメージはAmazon Linux 2です。</p>
		<p>現状、提出が発生するたびにサーバのインスタンス生成するところからやるようにしています。
			そのため、ジャッジが開始するまでが遅いです。</p>
	</div>
</body>

</html>