<?php
session_start();

require_once('./template/init.php');

if (!isset($_GET["user"])) {
	header("Location: ./");
	exit();
}

$user = $_GET["user"];

if (!preg_match("/^[a-zA-Z0-9]+$/", $user)) {
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
	<?php require_once('template/head.php') ?>
	<title>User: <?= $user ?></title>
</head>

<body>
	<?php
	require_once('template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>User: <?= $user ?></h1>
		<pre><?= var_dump($ranks) ?></pre>
	</div>
</body>

</html>