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
		<p style="font-size: 1.2em">資料集</p>
		<ul>
			<li><a href="http://threeprogramming.lolipop.jp/blog/?p=1164">マラソンマッチの資料集</a>（threecourseさん）</li>
			<li><a href="https://qiita.com/phocom/items/da0f8123f7a8d5201cbf">Topcoder Marathon Matchの始め方</a>（phocomさん）</li>
			<li><a href="https://github.com/kosakkun/mm-tester">mm-tester</a>（kosakkunさん）</li>
			<li><a href="https://togetter.com/id/masashinakata">twitter感想戦まとめ</a>(agwさん)</li>
		</ul>
		<h3>ただいま開発中！！！</h3>
		<p>現在、本サイトはオープンベータとして公開中です</p>
		<p>バク報告や欲しい機能は<a href="https://twitter.com/ats5515">開発者twitter</a>
			またはgithubのissue（以下）からお願いします。
			<ul>
				<li><a href="https://github.com/ats5515/MarathonOnlineJudge-judge/issues">ジャッジに関するもの</a></li>
				<li><a href="https://github.com/ats5515/MarathonOnlineJudge-problems/issues">問題に関するもの</a></li>
				<li><a href="https://github.com/ats5515/MarathonOnlineJudge-web/issues">ウェブに関するもの</a></li>
			</ul>
		</p>
		<h3>その他</h3>
		サイト利用のルールは<a href="./rule.php">こちら</a>を参照してください。
		<div style="margin-top: 300px"></div>
	</div>
	
</body>

</html>