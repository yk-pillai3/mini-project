<?php 
	session_start();
	include 'db.php';
	$delete=base64_decode(urldecode($_GET['delete']));
	$sql="delete from details where uname="."'".$delete."';";
	$mysqli->query($sql);
	header("location:listing.php");
 ?>