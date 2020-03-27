<?php
session_start();

require_once('./template/init.php');

if (!isset($_GET["id"])) {
	echo "invalid submission id";
	header("Location: /");
	exit();
}
$submission_id = $_GET["id"];

if (!preg_match("/\A[a-zA-Z0-9]+\z/", $submission_id)) {
	echo "invalid submission id";
	header("Location: ./");
	exit();
}

require_once('./template/useapi.php');
$progress = run_cmd('get_progress ' . $submission_id);

$result_str = run_cmd("get_s3_file_dircache submissions/$submission_id/result.json");
$result = null;
if (!empty($result_str)) {
	$result = json_decode($result_str, true);
}

$results = null;
if ($progress == "done") {
	$results_str = run_cmd("get_s3_file_dircache submissions/$submission_id/results.json");
	if (!empty($results_str)) {
		$results = json_decode($results_str, true);
	}
}
/*
$info_str = run_cmd("get_s3_file_dircache submissions/$submission_id/info.json");
if (empty($info_str)) {
	echo "submission does not exist";
	header("Location: ./");
	exit();
}
$info = json_decode($info_str, true);
*/
$source = run_cmd("get_source_by_id $submission_id");

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<?php require_once('./template/head.php') ?>
	<title>submission : <?= $submission_id ?></title>
	<script>
		window.document.onkeydown = function() {
			if (event.keyCode == 116) {
				event.keyCode = null;
				return false;
			}
		}
	</script>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	if (isset($result["problemId"])) {
		require_once('./template/problem_header.php');
		draw_problem_header($login_state, $login_user, $result["problemId"]);
	}
	?>
	<div class="ats-container">
		<table class="ats-table">
			<?php
			require_once('./template/submission_table.php');
			append_header();
			append_submission_result($result, $submission_id);
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
	<?php
	if ($results) {
	?>
		<div class="ats-container">
			<details>
				<summary>Results</summary>
				<table class="ats-table">
					<?php
					require_once('./template/results_table.php');
					append_results_header();
					foreach ($results as $case => $content) {
						append_results_content($case, $content, $case < 10);
					}
					?>
				</table>
			</details>
		</div>
	<?php
	}
	?>

	<div class="ats-container">
		<p>Source</p>
		<div id="code">
			<pre><code class="prettyprint linenums"><?= htmlspecialchars($source) ?></code></pre>
		</div>
	</div>
</body>

</html>