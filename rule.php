<?php
session_start();
require_once('./template/init.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Rules</title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	require_once('./template/info_header.php');
	draw_info_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Rules</h1>
		<ul>
			<li>問題ページの下部から提出できます</li>
			<li>提出は自由ですが、一度に複数で提出するときはなるべく前の提出のジャッジが終わってから次を提出するようにしてください。</li>
			<li>ジャッジサーバーを壊すような提出をしないでください。</li>
			<li>言語の仕様は<a href="./languages.php">こちら</a>を参照してください</li>
			<li>時間制限、メモリ制限が各問題に対して定まっています。</li>
			<li>ジャッジステータスの見方<a href="./judge_status.php">こちら</a>を参照してください</li>
			<li>順位表(standings)から、他ユーザの提出を見ることができます。</li>
			<li>提出の結果が"AC"であるもののみが順位表に載ります</li>
		</ul>
	</div>
</body>

</html>