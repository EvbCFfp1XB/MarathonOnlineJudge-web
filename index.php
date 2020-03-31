<?php
session_start();

require_once('./template/init.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>

	<title> Marathon Online Judge </title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Marathon Online Judge(仮)</h1>
		<h3>本サイトについて</h3>
		<p>最適化問題に特化したオンラインジャッジです。</p>
		<p>問題一覧はヘッダのProblemsまたは<a href="./problem_list.php">こちら</a>から見れます。</p>
		<p>問題への提出は問題ページの下部からできます。提出にはログインが必要です。</p>
		<h3>初心者の方へ</h3>
		<h4>資料集</h4>
		<ul>
			<li><a href="http://threeprogramming.lolipop.jp/blog/?p=1164">マラソンマッチの資料集（threecourseさん）</a></li>
			<li><a href="https://qiita.com/phocom/items/da0f8123f7a8d5201cbf">Topcoder Marathon Matchの始め方（phocomさん）</a></li>
			<li><a href="https://github.com/kosakkun/mm-tester">mm-tester（kosakkunさん）</a></li>
		</ul>
		<h3>ただいま開発中！！！</h3>
		<p>現在、本サイトはオープンベータとして公開中です</p>
		<p>バク報告や欲しい機能は<a href="https://twitter.com/ats5515">開発者twitter</a>
			またはgithubのissue（以下）からお願いします。
			<ul>
				<li style="display: inline"><a href="https://github.com/ats5515/MarathonOnlineJudge-judge/issues">ジャッジ</a></li>
				<li style="display: inline"><a href="https://github.com/ats5515/MarathonOnlineJudge-problems/issues">問題</a></li>
				<li style="display: inline"><a href="https://github.com/ats5515/MarathonOnlineJudge-web/issues">ウェブ</a></li>
			</ul>
		</p>
		<h3>その他</h3>
		サイト利用のルールは<a href="./rule.php">こちら</a>を参照してください。
	</div>
	<div style="margin-bottom: 50px"></div>
</body>

</html>