<!DOCTYPE html>
<html>
<head>
	<title>Max-Min-Avg</title>
	
</head>
<body>
	<form method="post" name="form">
		Enter numbers in a comma seperated manner:<input type="text" name="string" required autocomplete="off"><br>
		Select option: <select name="option" required autocomplete="off">
					<option value="">Choose option</option>
					<option>Max</option>
					<option>Min</option>
					<option>Avg</option>
					<option>Remove white spaces from beginning and end</option>
					<option>Count of vowels</option>
					<option>Most repeated vowel</option>
					<option>Sort</option>
					<option>Fibonacci?</option>
					<option>Krishnamurthy number?</option>
					<option>Prime?</option>
					<option>Print all anagrams</option>
				</select>
		<input type="submit" name="submit" value="Result">
	</form>
	
	

	<?php

	function vowel_count($string){
			return (substr_count($string,'a')+substr_count($string,'e')+substr_count($string,'i')+substr_count($string,'o')+substr_count($string,'u'));
	}

	function sortAsc($array){
			echo "Ascending order:";
			sort($array);
			for($x = 1; $x <= count($array); $x++) {
    		echo $array[$x-1];
    		if($x!=count($array)){
    		echo ",";
			}
		}
	}

	function prime($string){
    	if ($string == 1)
    	return 0;
    	for ($i = 2; $i <= $string/2; $i++){
        if ($string % $i == 0)
            return 0;
    	}
    	return 1;
	}

	function is_perf_square($string){
		$sqroot=sqrt($string);
		$isqroot=(int)$sqroot;
		$dsqroot=$sqroot-$isqroot;
		return $dsqroot;
	}

	function fibonacci($string){
		$x=$string;
		if (!is_perf_square(5*$x*$x-4) || !is_perf_square(5*$x*$x+4)) {
			//echo "hello";
			return "Yes";
		}else{
			//echo "hell";
			return "No";
		}
		
	}

	function sortDesc($array){
			echo "Descending order:";
			rsort($array);
			for($x = 1; $x <= count($array); $x++) {
    		echo $array[$x-1];
    		if($x!=count($array)){
    		echo ",";
			}
		}
	}

	function factorial($string){
    	$fact = 1;
    	while($string != 0)
    	{
        $fact = $fact * $string;
        $string--;
    	}
    	return $fact;
	}

	function krishnamurthy($string){
    	$sum = 0;
    	$temp = $string;
     	$len=strlen($string);
    	while($len != 0)
    	{
        $sum = $sum + factorial($temp % 10);
        $temp = $temp/10;
   		$len--;
    	}
     	if ($sum == $string) {
     		echo "Yes";
     	}else{
     		echo "No";
     	}
	}

	function permute($str, $l, $r)
		{
    	if ($l == $r)
        echo $str. "\n";
    	else
    	{
        for ($i = $l; $i <= $r; $i++)
       	 {
            $str = swap($str, $l, $i);
            permute($str, $l + 1, $r);
            $str = swap($str, $l, $i);
        }
    	}
	}
 

	function swap($a, $i, $j)
		{
    	$temp;
    	$charArray = str_split($a);
    	$temp = $charArray[$i] ;
   		 $charArray[$i] = $charArray[$j];
    	$charArray[$j] = $temp;
    	return implode($charArray);	
	}

	function most_repeated_vowel($string){
			$a=substr_count($string,'a');
			$e=substr_count($string,'e');
			$i=substr_count($string,'i');
			$o=substr_count($string,'o');
			$u=substr_count($string,'u');
			$max=max($a,$e,$i,$o,$u);
			if($a==$max){
				echo "a"." ";
			}
			if($e==$max){
				echo "e"." ";
			}
			if($i==$max){
				echo "i"." ";
			}
			if($o==$max){
				echo "o"." ";
			}
			if($u==$max){
				echo "u"." ";
			}


	}


		if (isset($_POST['submit'])) {
			$string=trim($_POST['string']);
			$array=explode(",",$string);

			$option=$_POST['option'];
			
                switch ($option) {
                    case 'Max':
                        echo max($array);
                        break;
                    case 'Min':
                        echo min($array);
                        break;
                    case 'Avg':
                        echo array_sum($array)/count($array);
                        break;
                    case 'Remove white spaces from beginning and end':
                        echo trim($string);
                        break;
                    case 'Count of vowels':
                    	echo vowel_count($string);
                    	break;
                    case 'Most repeated vowel':
                    	echo most_repeated_vowel($string);
                    	break;
                    case 'Sort':
                    	echo sortAsc($array);
                    	echo "<br>";
                    	echo sortDesc($array);
                    	break;
                    case 'Fibonacci?':
                    	echo fibonacci($string);
                    	break;
                    case 'Krishnamurthy number?':
                    	echo krishnamurthy($string);
                    	break;
                    case 'Prime?':
                    	if (prime($string)) {
                    		echo "Yes";
                    	}else{
                    		echo "No";
                    	}
                    case 'Print all anagrams':
                    	$n=strlen($string);
                    	permute($string,0,$n-1);
                    	break;
                }
		}
	?>
</body>
</html>