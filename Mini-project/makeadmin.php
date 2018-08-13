<?php 
	session_start();
	include 'db.php';
	$makeadmin=base64_decode(urldecode($_GET['makeadmin']));
	$sql="update details set type='admin' where uname="."'".$makeadmin."';";
	$mysqli->query($sql);
	header("location:listing.php");
 ?>