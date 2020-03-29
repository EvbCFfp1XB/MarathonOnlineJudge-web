<?php
session_start();

require_once('./template/init.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<meta name="description" content="ページの説明文" />
	<title> Marathon Online Judge </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	echo "test3";
	?>
	<div class="ats-container">
		<h1>Marathon Online Judge(仮)</h1>
		<h3>本サイトについて</h3>
		<p>競技プログラミングにおけるマラソン系の問題に特化したオンラインジャッジです。</p>
		<p>マラソン系のコンテストでは、いわゆる最適化問題という種類の問題が出題されます。
			より一般的なアルゴリズムコンテストとは異なり、マラソン系の問題では正解の明確な基準ではなく
			スコアの計算方法が与えられます。提出プログラムは、その計算方法に基づきスコアリングされます。</p>
		<p>問題一覧はヘッダのProblemsまたは<a href="./problem_list.php">こちら</a>から見れます。</p>
		<p>問題への提出は問題ページの下部からできます。提出にはログインが必要です。</p>

		<h3>ルール等</h3>
		<a href="./rule.php">こちら</a>を参照してください。
		<h3>ただいま開発中！！！</h3>
		<p>現在、本サイトはオープンベータとして公開中です</p>
		<p>バク報告や欲しい機能は<a href="https://twitter.com/ats5515">開発者twitter</a>
			または<a href="https://github.com/ats5515/MarathonOnlineJudge-judge/issues">githubのissue</a>
			からお願いします。</p>
	</div>
	<div style="margin-bottom: 50px"></div>
</body>

</html>