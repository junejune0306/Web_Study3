<?php
	error_reporting( E_ALL );
	ini_set( "display_errors", 1 );
	session_start();
	if (empty($_SESSION['num'])) {
                $number = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
                shuffle($number);
                $_SESSION['num'] = $number[0].$number[1].$number[2];
                $_SESSION['anslist'] = "";
		$_SESSION['count'] = 0;
		$_SESSION['end'] = 0;
                echo 'game started<br>';
        }
	echo $_SESSION['num'].'<br>';
?>
<html>
	<head>
		<title> cert html 3 숫자야구 22김민재 </title>
	</head>
	<body>
		<form method="post" action="./compare.php">
			숫자 세개 입력: <input type="text" name="num"/>
			<input type="submit" value="입력"/>
		</form>
		<form method="post" action="./end.php">
			<input type="submit" value="초기화"/>
		</form>
	</body>
</html>
<?php
	print_r($_SESSION['anslist']);
        foreach ($_SESSION['anslist'] as $i)
                echo $i.'<br>';
?>
