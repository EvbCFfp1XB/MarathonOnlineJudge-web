<?php
session_start();

require_once('./template/init.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<meta name="description" content="ページの説明文" />
	<title> Marathon Online Judge </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Marathon Online Judge(仮)</h1>
		<h3>本サイトについて</h3>
		<p>競技プログラミングにおけるマラソン系の問題に特化したオンラインジャッジです。</p>
		<p>ただいま開発中！！！</p>
	</div>
</body>

</html>