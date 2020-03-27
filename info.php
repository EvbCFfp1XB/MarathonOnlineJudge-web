<?php
session_start();

require_once('./template/init.php');

header("Location:" . "./languages.php");

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
</body>

</html>