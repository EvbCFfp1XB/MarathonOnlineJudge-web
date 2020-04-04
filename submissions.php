<?php
session_start();

require_once('./template/init.php');
require_once('./template/useapi.php');
$BLOCK = 20;

$data_json = null;
$sub_id = null;
$problem = null;
$user = null;
$page = 0;
$total = 0;
if (isset($_GET["page"])) {
	$page = (int) $_GET["page"];
}

if (isset($_GET["problem"]) && isset($_GET["user"])) {
	$problem = $_GET["problem"];
	$user = $_GET["user"];

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $problem)) {
		header("Location: ./");
		exit();
	}

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $user)) {
		header("Location: ./");
		exit();
	}

	$result_str = run_cmd("get_s3_file_dircache cache/$problem/$user/pu_result.json");
	if (!empty($result_str)) {
		$data_json  = array_reverse(json_decode($result_str, true), true);
	}
	$total = count($data_json);
} else if (isset($_GET["user"])) {
	$user = $_GET["user"];

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $user)) {
		header("Location: ./");
		exit();
	}

	$result_str = run_cmd("get_s3_file_dircache user/$user/u_result.json");
	if (!empty($result_str)) {
		$data_json  = array_reverse(json_decode($result_str, true), true);
	}
	$total = count($data_json);
} else if (isset($_GET["problem"])) {
	$problem = $_GET["problem"];

	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $problem)) {
		header("Location: ./");
		exit();
	}

	$result_str = run_cmd("get_s3_file cache/$problem/p_result.json");
	if (!empty($result_str)) {
		$data_json  = array_reverse(json_decode($result_str, true), true);
	}
	$total = count($data_json);
} else {

	$result_str = run_cmd("get_s3_file cache/all_result.json");
	if (!empty($result_str)) {
		$data_json  = array_reverse(json_decode($result_str, true), true);
	}
	$total = count($data_json);


	// $last_id = run_cmd("get_last_id");
	// for ($i = 0; $i < $BLOCK; $i++) {
	// 	$sub_id[$i] = $last_id - ($page * $BLOCK + $i);
	// }
	// $total = $last_id;
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Submissions </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	if ($problem) {
		require_once('./template/problem_header.php');
		draw_problem_header($login_state, $login_user, $problem, null);
	}
	//var_dump($data_json);
	//exit();
	?>
	<div class="ats-container">
		<h1>Submissions <span style="font-size: 50%">
				<?php
				if ($problem) {
					echo "problem: $problem, ";
				}
				if ($user) {
					echo "user: $user, ";
				}
				?>
			</span></h1>
		<div class="ats-page-button">
			<ul>
				<?php
				$pages = floor(($total + $BLOCK - 1) / $BLOCK);
				if ($pages >= 2) {
					$uri = "./submissions.php?";
					foreach ($_GET as $key => $val) {
						if ($key != "page") {
							$uri = $uri . $key . "=" . $val . "&";
						}
					}
					for ($page_itr = 0; $page_itr < $pages; $page_itr++) {
				?>
						<li <?php
							if ($page == $page_itr) echo 'class = "selected"'
							?>>
							<a href="<?= $uri ?>page=<?= $page_itr ?>"><?= $page_itr ?></a>
						</li>
				<?php
					}
				}
				?>
			</ul>
		</div>
		<?php
		if ($data_json) {
		?>
			<table class="ats-table">
				<?php
				require_once('./template/submission_table.php');
				append_header();
				$cnt = 0;
				foreach ($data_json as $submission_id => $result) {
					if ($cnt >= $BLOCK * $page && $cnt < $BLOCK * ($page + 1)) {
						append_submission_result($result, $submission_id);
					}
					$cnt++;
				}
				?>
			</table>
		<?php
		} else if ($sub_id) {
			require_once('./template/submission_table.php');
			draw_table($sub_id);
		}
		?>
	</div>
</body>

</html>