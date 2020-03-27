<?php
function append_header()
{
?>
	<tr>
		<th>ID</th>
		<th>Date</th>
		<th>Problem</th>
		<th>User</th>
		<th>Score</th>
		<th>Lang</th>
		<th>Status</th>
		<th>Time</th>
		<th>Memory</th>
	</tr>
<?php
}
?>
<?php
function append_submission_result($result, $sub_id)
{
	if (!preg_match("/\A[a-zA-Z0-9]+\z/", $sub_id)) {
		header("Location: ./");
		exit();
	}
	if (!$result) {
		$info_str = run_cmd("get_s3_file_dircache submissions/$sub_id/info.json");
		if (empty($info_str)) {
			echo "submission does not exist";
			header("Location: ./");
			exit();
		}
		$result = json_decode($info_str, true);
	}
	$progress = null;
	if (isset($result["status"]) && $result["status"] != "WJ") {
		$progress = "done";
	} else {
		$progress = str_replace(PHP_EOL, '', run_cmd('get_progress ' . $sub_id));
	}

	require_once(__DIR__ . "/useapi.php");
	$prob_dir = run_cmd_exec("problems_path", $TMP, $TMP);
	$id = $result["problemId"];
	$config_str = file_get_contents("$prob_dir/$id/config.json");
	if (!$config_str) {
		header("Location: /");
		exit();
	}
	$config = json_decode($config_str, true);

?>

	<tr>
		<td><a href="./submission.php?id=<?= $sub_id ?>"><?= $sub_id ?></a></td>
		<td><?= $result["date"] ?></td>
		<td><a href="./problem.php?id=<?= $result["problemId"] ?>"><?= $config["name"] ?></a></td>
		<td><a href="./user.php?user=<?= $result["user"] ?>"><?= $result["user"] ?></a></td>
		<td>
			<?php
			if ($progress == "done") {
				echo $result["score"];
			} else {
				echo "-";
			}
			?>
		</td>
		<td><?= $result["lang"] ?></td>
		<td>
			<?php
			$status = "WJ";
			$status_class = "WJ";
			if ($progress == "done") {
				$status = $result["status"];
				$status_class = $status;
			} else if ($progress == "WJ") {
				$status = "WJ";
				$status_class = $status;
			} else {
				$status = $progress . "/" . $config["num_testcases"];
				$status_class = "WJ";
			}
			echo "<span class=\"ats-label $status_class\">$status</span>";
			?>
		</td>
		<td>
			<?php
			if ($progress == "done") {
				echo (string) ($result["time"]) . "ms";
			} else {
				echo "-";
			}
			?>
		</td>
		<td>
			<?php
			if ($progress == "done") {
				echo (string) ((int) $result["memory"] / 1024) . "KB";
			} else {
				echo "-";
			}
			?>
		</td>
	</tr>
<?php
}
?>