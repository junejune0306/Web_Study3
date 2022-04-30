<html>
	<head>
		<title> cert html 3 실습#1 22김민재 </title>
	</head>
	<body>
		<form method="post" action="">
			입력: <input type="text" name="num"/>
			<input type="submit" value="전송"/>
		</form>
	</body>
</html>
<?php
        for($i = 1; $i <= 9; $i++) {
                echo $_POST['num']."X".$i." = ".$_POST['num']*$i."<br>";
        }
?>

