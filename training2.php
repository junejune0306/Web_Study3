<html>
	<head>
		<title> cert html 3 실습#2 22김민재 </title>
	</head>
	<body>홀수 짝수
		<form method="post" action="">
			시작: <input type="text" name="num"/>
			홀수<input type="radio" name="choose" value="odd"/>
			짝수<input type="radio" name="choose" value="even"/>
			<input type="submit" value="입력"/>
		</form>
	</body>
</html>
<?php
	$tmp = 1;
	$sum = 0;
	if ($_POST['choose'] == even) {
		$tmp = 2;
	}
	for ($i = $tmp; $i <= $_POST['num']; $i += 2) {
		echo $i;
		$sum += $i;
		if ($i < $_POST['num'] - 1) {
			echo " + ";
		}
	}
	echo "=".$sum;
	
?>
