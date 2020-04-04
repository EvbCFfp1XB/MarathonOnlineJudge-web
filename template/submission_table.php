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
		$result_str = run_cmd("get_s3_file_dircache submissions/$sub_id/result.json");
		if (empty($result_str)) {
			$result_str = run_cmd("get_s3_file_dircache submissions/$sub_id/info.json");
			if (empty($result_str)) {
				return;
			}
		}
		$result = json_decode($result_str, true);
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
		return;
	}
	$config = json_decode($config_str, true);

?>

	<tr id="sub_<?= $sub_id ?>">
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

<?php

function draw_table($sub_ids)
{
?>
	<table class="ats-table">
		<?php
		append_header();
		foreach ($sub_ids as $sub_id) {
		?>
			<tr id="sub_<?= $sub_id ?>">
				<?php
				?>
			</tr>
		<?php
		}
		?>
	</table>
	<?php
	?>
	<script>
		$(window).on('load', function() {
			<?php
			foreach ($sub_ids as $sub_id) {
			?>
				$.ajax({
					url: "./submission_row.php",
					type: "post",
					dataType: "text",
					cache: false,
					data: {
						'sub_id': <?= $sub_id ?>
					}

				}).done(function(response) {
					//alert(response);
					document.getElementById("sub_<?= $sub_id ?>").outerHTML = response;
				}).fail(function(xhr, textStatus, errorThrown) {
					//alert(errorThrown);
				});
			<?php
			}
			?>
		});
	</script>
<?php
}
?>