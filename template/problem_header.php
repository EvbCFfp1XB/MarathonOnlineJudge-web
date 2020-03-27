<?php
function draw_problem_header($login_state, $login_user, $problem)
{
	if (!$problem) {
		exit();
	}
?>

	<header class="ats-sub-header">
		<div class="ats-sub-navbar ats-navbar-left">
			<ul>
				<li class="ats-sub-logo">Problem: <?= $problem ?></li>
				<li><a href="./problem.php?id=<?= $problem ?>">Problem</a></li>
				<li><a href="./standings.php?id=<?= $problem ?>">Standings</a></li>
				<li>
					<a href="https://github.com/ats5515/MarathonOnlineJudge-problems/tree/master/<?= $problem ?>">JudgeCode</a>
				</li>
				<?php
				if ($login_state) {
				?>
					<li><a href="./submissions.php?user=<?= $login_user ?>&problem=<?= $problem ?>">My Submissions</a></li>
				<?php
				}
				?>
			</ul>
		</div>
		<div style="clear: both"></div>
	</header>
<?php
}
?>