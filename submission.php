<?php
session_start();

require_once('./template/init.php');

if (!isset($_GET["id"])) {
	header("Location: /");
	exit();
}
$submission_id = $_GET["id"];

if (!preg_match("/^[a-zA-Z0-9]+$/", $submission_id)) {
	header("Location: ./");
	exit();
}

require_once('template/useapi.php');
$progress = run_cmd('get_progress ' . $submission_id);

$result_str = run_cmd("get_s3_file_dircache submissions/$submission_id/result.json");
$result = null;
if (!empty($result_str)) {
	$result = json_decode($result_str, true);
}


$info_str = run_cmd("get_s3_file_dircache submissions/$submission_id/info.json");
if (empty($info_str)) {
	header("Location: ./");
	exit();
}


$info = json_decode($info_str, true);
$source = run_cmd("get_source_by_id $submission_id");

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<?php require_once('./template/head.php') ?>
	<title>submission : <?= $submission_id ?></title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<table class="ats-table">
			<?php
			require_once('template/submission_table.php');
			append_header();
			append_submission_result($progress, $result, $info, $submission_id);
			?>
		</table>
	</div>

	<?php
	if (isset($result["status"]) && $result["status"] == "CE") {
		$ERROR_MSG = run_cmd("get_s3_file_dircache submissions/$submission_id/CE.txt");
	?>
		<div class="ats-container">
			<p>Error Messege</p>
			<div id="CE">
				<pre><?= htmlspecialchars($ERROR_MSG) ?></pre>
			</div>
		</div>
	<?php
	}
	?>

	<div class="ats-container">
		<p>source</p>
		<div id="code">
			<pre><code class="prettyprint linenums"><?= htmlspecialchars($source) ?></code></pre>
		</div>
	</div>
</body>

</html>