<?php
	session_start();
	$num = $_SESSION['num'];
	$strike = 0;
        $ball = 0;
        $input = $_POST['num']."";

        for ($i = 0; $i < 3; $i++)
                if (substr($num,$i,1) == substr($input,$i,1))
                        $strike++;
        for ($i = 0; $i < 3; $i++)
                for ($j = 0; $j < 3; $j++)
                        if($i != $j)
                                if (substr($input,$i,1) == substr($num,$j,1))
                                        $ball++;
        #echo gettype($input)." ".gettype($num)."<br>";
        $_SESSION['anslist'][] = $input.' -> '.'S: '.$strike.' B: '.$ball. ' O: '.(3-$strike-$ball);
	$_SESSION['count']++;
	header('Location: ./main.php');
?>
