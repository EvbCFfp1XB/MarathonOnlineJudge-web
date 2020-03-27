<?php
function append_results_header()
{
?>
	<tr>
		<th>Case</th>
		<th>Score</th>
		<th>Status</th>
		<th>Time</th>
		<th>Memory</th>
	</tr>
<?php
}
?>
<?php
function append_results_content($case, $result, $rich)
{

?>

	<tr>
		<td><?= $case ?></td>
		<td>
			<?php
			if ($rich) {
				echo $result["score"];
			} else {
				echo "-";
			}
			?>
		</td>
		<td>
			<?php
			$s = $result["status"];
			echo "<span class=\"ats-label $s\">$s</span>";
			?>
		</td>
		<td>
			<?php
			echo (string) ($result["time"]) . "ms";
			?>
		</td>
		<td>
			<?php
			echo (string) ((int) $result["memory"] / 1024) . "KB";
			?>
		</td>
	</tr>
<?php
}
?>