<?php
		$request=$_POST['request'];
		include 'db.php';
		$sql="select * from details where uname like"."'%".$request."%';";
		$result=$mysqli->query($sql);
		$results_per_page=5;
	$no_of_results=mysqli_num_rows($result);
	$no_of_pages=ceil($no_of_results/$results_per_page);
		
	if (!isset($_GET['page'])) {
		$page=1;
	}else{
		$page=$_GET['page'];
	}
		
		$this_page_first_result=($page-1)*$results_per_page;
		$sql="select uname,pic_path,type from details where type='user' && uname like"."'%".$request."%' " ."limit ". $this_page_first_result .",".$results_per_page;
		$result=$mysqli->query($sql);

		echo "<table border='1' align='center'><tr><th>Profile Picture</th><th>Name</th><th colspan=3>Options</th></tr>";
		while ($row=$result->fetch_assoc()) {
			
			$uname=urlencode(base64_encode($row['uname']));
			$pic_path=$row['pic_path'];
			echo "<tr><td align='center'><img src='$pic_path' height='50' width='50'></td><td>".$row['uname']."</td><td>"."<a href='view.php?view=$uname'>View</a>"."</td><td>"."<a href='delete.php?delete=$uname'>Delete</a>"."</td><td>"."<a href='makeadmin.php?makeadmin=$uname'>Make Admin</a>"."</td><tr>";
			
			
		}
		echo "</table>";
		echo "<div id=pgnos align='center'>";
		for ($page=1; $page<=$no_of_pages ; $page++) { 
			echo "<a href='listing.php?page=" .$page. "'>".$page."</a>";
			echo "&nbsp&nbsp";
		}
		echo "</div>";
	
?>