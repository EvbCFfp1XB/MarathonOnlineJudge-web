<?php
session_start();
require_once('./template/init.php');

?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<?php require_once('./template/head.php') ?>
	<title>Judge Status</title>
</head>

<body>
	<?php
	require_once('./template/web_header.php');
	draw_web_header($login_state, $login_user);
	require_once('./template/info_header.php');
	draw_info_header($login_state, $login_user);
	?>
	<div class="ats-container">
		<h1>Judge Status</h1>
		<table class="ats-table">
			<tr>
				<th>Status</th>
				<th>Description</th>
			</tr>
			<tr>
				<td><span class="ats-label AC">AC</span></td>
				<td>出力が条件を満たす。ACの提出のみが順位表に載る</td>
			</tr>
			<tr>
				<td><span class="ats-label CE">CE</span></td>
				<td>コンパイル時エラー</td>
			</tr>
			<tr>
				<td><span class="ats-label WA">WA</span></td>
				<td>出力が条件を満たさない</td>
			</tr>
			<tr>
				<td><span class="ats-label TLE">TLE</span></td>
				<td>プログラムが制限時間を超過する</td>
			</tr>
			<tr>
				<td><span class="ats-label MLE">MLE</span></td>
				<td>プログラムがメモリ制限を超過する</td>
			</tr>
			<tr>
				<td><span class="ats-label RE">RE</span></td>
				<td>プログラムが実行中に異常終了する</td>
			</tr>
			<tr>
				<td><span class="ats-label OLE">OLE</span></td>
				<td>プログラムの出力サイズが32MBを超過する(未実装)</td>
			</tr>
			<tr>
				<td><span class="ats-label IE">IE</span></td>
				<td>ジャッジ側のエラー。これが出たら報告よろしくお願いします</td>
			</tr>
		</table>
	</div>
</body>

</html>