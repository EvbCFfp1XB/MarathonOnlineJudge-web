<?php
function append_problems_header()
{
?>
	<tr>
		<th>Problem</th>
		<th>Status</th>
		<th>Tags</th>
		<th>Judge</th>
		<th>Standings</th>
		<th>Rank</th>
	</tr>
<?php
}
?>
<?php
function append_problem_config($id, $config, $ranks)
{
	$submit = false;
	$rank = "-";
	if (isset($ranks[$id])) {
		$rank = $ranks[$id]["rank"];
		$submit = true;
	}
?>

	<tr <?php
		if ($submit) {
		?> style="background-color: rgb(200,255,255)" <?php
													}
														?>>
		<td><a href="./problem.php?id=<?= $id ?>"><?= $config["name"] ?></a></td>
		<td><?= $config["status"] ?></td>
		<td>
			<?php
			foreach ($config["tags"] as $tag) {
				echo "$tag ";
			}
			?>
		</td>
		<td>
			<?php
			if ($config["judgetype"] == "normal") {
				echo "通常";
			} else if ($config["judgetype"] == "twice") {
				echo "2回実行";
			} else if ($config["judgetype"] == "interactive") {
				echo "インタラクティブ";
			}
			?>
		</td>
		<td><a href="./standings.php?id=<?= $id ?>">standings</a></td>
		<td><?= $rank ?></td>
	</tr>
<?php
}
?>