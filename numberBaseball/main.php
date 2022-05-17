<?php
	session_start();
	if (!isset($_SESSION['start'])) { //default setting
		$_SESSION['start'] = 0;
		$_SESSION['nd'] = array(); //number data
		$_SESSION['ad'] = array(); //Strike Ball Out (SBO) data
		$_SESSION['count'] = 0;
		$arr = array(0,1,2,3,4,5,6,7,8,9);
		shuffle($arr);
		$_SESSION['answer'] = array($arr[0], $arr[1], $arr[2]); //answer
	}
	else {
		$c = ++$_SESSION['count'];
		$s = 0; $b = 0;
		$p = array($_POST['1'], $_POST['2'], $_POST['3']);
		for ($i = 0; $i < 3; $i++) {
			$_SESSION['nd'][] = $p[$i]; //append POSTs to nd
			for ($j = 0; $j < 3; $j++) { //calculate SBO
				if ($_SESSION['answer'][$i] == $p[$j]) {
					if ($i == $j) $s++;
					else $b++;
				}
			}
		}
		for ($i = 0; $i < $s; $i++) //append SBO to ad
			$_SESSION['ad'][] = 's';
		for ($i = 0; $i < $b; $i++)
			$_SESSION['ad'][] = 'b';
		for ($i = 0; $i < 3 - $s - $b; $i++)
			$_SESSION['ad'][] = 'o';
	}
?>
<html>
	<head>
		<meta method="utf-8">
		<title>Number Baseball</title>
		<link rel="stylesheet" href="./main.css">
	</head>
	<body>
	<form method='post' action='reset.php'>
		<input type='submit' id='resetButton' value='Reset'>
	</form>
	<center>
		<div id='title'>Number Baseball</div>
		<div id='nums'><?php $np = 0; $ap = 0;
			for ($i = 0; $i < $c - 1; $i++) { //already done divs
				for ($j = 0; $j < 3; $j++)
					echo '<div class=\''.$_SESSION['ad'][$ap++].'\'>'.$_SESSION['nd'][$np++].'</div>';
				echo '<br>';
			}
			if ($c > 0) { //current input div
				echo '<span id=\'ans\'>';
				for ($i = 0; $i < 3; $i++)
					echo '<div>'.$_SESSION['nd'][$np++].'</div>';
				echo '<br></span>';
			}
			echo '<span id=\'input\'><div></div><div></div><div></div><br></span>'; //to recieve div
			for ($i = 0; $i < 9 - $c; $i++) //blank divs
				echo '<div></div><div></div><div></div><br>';
		?></div>
	</center></body>
	<form method='post' action='' id='sub'><input type='hidden' name='1'><input type='hidden' name='2'><input type='hidden' name='3'></form>
</html>
<script>
	function dec(div, tmp, c) { //flip, decreasing
		div.style = 'transform: scale(1, ' + tmp + ')';
		if (tmp > 0) setTimeout(dec, 5, div, tmp - 0.05, c);
		else {
			div.className = c;
			setTimeout(inc, 5, div, tmp + 0.05);
		}
	}
	function inc(div, tmp) { //flip, increasing
		div.style = 'transform: scale(1, ' + tmp + ')';
		if (tmp < 1) setTimeout(inc, 5, div, tmp + 0.05);
	}
	<?php //set className current input
		if ($c > 0) {
			?>
			var ans = document.getElementById('ans');
			<?php
			for ($i = 0; $i < 3; $i++)
				echo 'setTimeout(dec, 0, ans.childNodes['.$i.'], 1.0, \''.$_SESSION['ad'][$ap++].'\');';
		}
	?>
	var ptr = 0;
	var list = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1]; //untyped number list
	window.addEventListener("keydown", e => {
		if (isFinite(e.key)) {
			if (ptr < 3 && list[e.key]) document.getElementById('input').childNodes[ptr++].innerHTML = e.key;
			list[e.key] = 0;
		}
		else if (e.key == 'Backspace') {
			if (ptr > 0) {
				list[parseInt(document.getElementById('input').childNodes[--ptr].innerHTML)] = 1;
				document.getElementById('input').childNodes[ptr].innerHTML = '';
			}
		}
		else if (e.key == 'Enter') {
			if (ptr == 3) {
				for (var i = 0; i < 3; i++)
					document.getElementById('sub').childNodes[i].value = document.getElementById('input').childNodes[i].innerHTML;
				document.getElementById('sub').submit();
			}
		}
		if (ptr == 1) list = [1, 1, 1, 1, 1, 1, 1, 1, 1, 1]; //reset list if input is empty
	});
</script>
