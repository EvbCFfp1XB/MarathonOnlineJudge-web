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
		<p>AWS EC2(イメージ: Amazon Linux 2)</p>
		<p>インスタンスタイプはt2.micro。CPU周波数は2.4GHz。</p>
		<p>お金に余裕が出来たら強いのに変えたい</p>
	</div>
</body>

</html>