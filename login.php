<?php
session_start();
require_once('./template/init.php');
require_once('./template/auth.php');
//check posted
$MSG = "";
$login_result = false;
if (isset($_POST["username"]) && isset($_POST["password"])) {
	if (isset($_SESSION["moj-token"]) && isset($_POST["token"])) {
		if ($_SESSION["moj-token"] == $_POST["token"]) {
			$username = $_POST["username"];
			$password = $_POST["password"];
			list($login_result, $MSG) = verify_login($username, $password);
			if ($login_result) {
				$_SESSION["username"] = $username;
				//$_SESSION["password"] =  password_hash($password, PASSWORD_DEFAULT);
				if (isset($_POST["before"])) {
					header("Location:" . $_POST["before"]);
				} else {
					header("Location:" . "./index.php");
				}
				exit();
			}
		} else {
			$MSG = "token error";
		}
	} else {
		$MSG = "token error";
	}
}
$init_username = "";
if (isset($_POST['username'])) {
	$init_username = $_POST['username'];
} else if (isset($_SESSION['username'])) {
	$init_username = $_POST['username'];
}

$token = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["moj-token"] = $token;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title> Login </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div>
		<?php
		if (!$login_result) {
			echo "<p>$MSG</p>";
		}
		?>
	</div>

	<div class="ats-container">
		<h1>Login</h1>
		<form action="./login.php" class="ats-form" method="POST">
			<input name="before" value="<?= $url_before ?>" hidden>
			<input name="token" value="<?= $token ?>" hidden>

			<label for="username">username</label>
			<input type="text" id="username" name="username" placeholder="username" value="<?= $init_username ?>" maxlength="32" autocomplete="OFF" />
			<label for="password">password</label>
			<input type="password" id="password" name="password" placeholder="password" maxlength="32" autocomplete="OFF" />

			<input type="submit" value="Login" />
		</form>
		<a href="./register.php">Register</a>
	</div>
</body>

</html>