<?php
	session_start();
	$f = 0;
	if(!isset($_SESSION['start'])) { //최초 접속 초기 설정
		$_SESSION['start'] = 1;
		$_SESSION['words'] = array('시작');
		$_SESSION['score'] = 0;
	}
	else { //POST 글자를 받아 실행
		$s = $_SESSION['score'];//마지막 단어의 끝글자와 입력한 단어의 첫글자가 같다면, 또는 한글만 입력되었다면 통과
		if (mb_substr($_SESSION['words'][$s], -1, 1, 'UTF-8') == mb_substr($_POST['word'], 0, 1, 'UTF-8') && preg_match('/^[가-힣]{6,60}$/', $_POST['word'], $m)) {
			$_SESSION['words'][] = $_POST['word'];
			$_SESSION['score']++;
			$f = 1;
		}
	}
?>
<html>
	<head>
		<meta method="utf-8">
		<title>끝말잇기</title>
		<link rel="stylesheet" href="./main.css">
	<head>
	<body>
                <form id="reset" method="post" action="./reset.php" onkeydown="return event.key != 'Enter';">
                        <input id="resetbutton" type="submit" value="Restart">
                </form>
		<center><br>
		<h1>끝말잇기</h1>
		<div id="div">
			<table><?php //행을 생성하고 $_SESSION['words']의 단어들을 마지막 인덱스부터 자례대로 집어넣는다
				for ($i = $_SESSION['score']; $i >= 0; $i--) {
					echo "<tr><td>".($i + 1)."</td><td>".$_SESSION['words'][$i]."</td></tr>";
				}
			?></table>
		</div>
		<br><br>
		<div><?php echo mb_substr($_SESSION['words'][$_SESSION['score']], 0, -1, 'UTF-8')."<span>".mb_substr($_SESSION['words'][$_SESSION['score']], -1, 1, 'UTF-8')."</span>"; //마지막으로 입력한 단어 출력?> -> 
		<form id="input" method="post" action=""> <?php//단어를 잘못 입력했다면 단어를 그대로 반환한다?>
			<input type="text" id="word" name="word" maxlength="20" autocomplete="off" autofocus <?php if (!$f) {echo 'value="'.$_POST['word'].'"';}?>>
		</form><br><br>
		</div>
	</center></body>
</html>
