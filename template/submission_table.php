<?php
function append_header()
{
?>
	<tr>
		<th>ID</th>
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
function append_submission_result($progress, $result, $info, $sub_id)
{
	require_once(__DIR__ . "/useapi.php");
	$prob_dir = run_cmd_exec("problems_path", $TMP, $TMP);
	$id = $info["problemId"];
	$config_str = file_get_contents("$prob_dir/$id/config.json");
	if (!$config_str) {
		header("Location: /");
		exit();
	}
	$config = json_decode($config_str, true);

?>

	<tr>
		<td><a href="./submission.php?id=<?= $sub_id ?>"><?= $sub_id ?></a></td>
		<td><a href="./problem.php?id=<?= $info["problemId"] ?>"><?= $config["name"] ?></a></td>
		<td><?= $info["user"] ?></td>
		<td>
			<?php
			if ($progress == "done") {
				echo $result["score"];
			} else {
				echo "-";
			}
			?>
		</td>
		<td><?= $info["lang"] ?></td>
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