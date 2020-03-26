<?php
session_start();

require_once('./template/init.php');
require_once('template/auth.php');

//check posted
$MSG = "";
if (
	isset($_POST["username"]) &&
	isset($_POST["password1"]) &&
	isset($_POST["password2"])
) {

	if ($_POST["password1"] != $_POST["password2"]) {
		$register_result = false;
		$MSG = "retype incorrect";
	} else {
		$username = $_POST["username"];
		$password = $_POST["password1"];
		list($register_result, $MSG) = verify_register($username, $password);
		if ($register_result) {
			$_SESSION["username"] = $username;
			//$_SESSION["password"] =  password_hash($password, PASSWORD_DEFAULT);
			$MSG = "success";
			header("Location: ./index.php");
			exit();
		}
	}
}
$init_username = "";
if (isset($_POST['username'])) {
	$init_username = $_POST['username'];
} else if (isset($_SESSION['username'])) {
	$init_username = $_SESSION['username'];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('template/head.php') ?>
	<title> Register </title>
</head>

<body>
	<?php
	require_once('template/web_header.php');
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
		<h1>Register</h1>
		<form action="./register.php" class="ats-form" method="POST">
			<label for="username">username</label>
			<input type="text" id="username" name="username" placeholder="username" value="<?= $init_username ?>" maxlength="32" autocomplete="OFF" />

			<label for="password1">password</label>
			<input type="password" id="password1" name="password1" placeholder="password" maxlength="32" autocomplete="OFF" />

			<label for="password2">retype password</label>
			<input type="password" id="password2" name="password2" placeholder="password" maxlength="32" autocomplete="OFF" />

			<input type="submit" value="Register" />
		</form>
		<a href="./login.php">Login</a>
	</div>
</body>

</html>