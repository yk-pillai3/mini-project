<?php
	session_start();
	include 'header.php';
	include 'db.php';
?>
<?php
	$view=base64_decode(urldecode($_GET['view']));
	$sql="select * from details where uname="."'".$view."';";
	$result=$mysqli->query($sql);
	while ($row=$result->fetch_assoc()) {
		$fname=$row['fname'];
		$lname=$row['lname'];
		$contact=$row['contact'];
		$gender=$row['gender'];
		$date=$row['date'];
		$email=$row['email'];
		$p_hloc=$row['p_hloc'];
		$p_street=$row['p_street'];
		$p_city=$row['p_city'];
		$p_pin=$row['p_pin'];
		$r_hloc=$row['r_hloc'];
		$r_street=$row['r_street'];
		$r_city=$row['r_city'];
		$r_pin=$row['r_pin'];
		$pic_path=$row['pic_path'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>View</title>
</head>
<body>
	<table border="1">
		<tr><td colspan="3" align="center"><img src="<?php echo $pic_path; ?>" height="50" width="50"></td></tr>
		<tr>
			<td>First name :</td>
			<td><?php echo $fname; ?></td>
		</tr>
		<tr>
			<td>Last name :</td>
			<td><?php echo $lname; ?></td>
		</tr>
		<tr>
			<td>Contact :</td>
			<td><?php echo $contact; ?></td>
		</tr>
		<tr>
			<td>Gender :</td>
			<td><?php echo $gender; ?></td>
		</tr>
		<tr>
			<td>Date :</td>
			<td><?php echo $date; ?></td>
		</tr>
		<tr>
			<td>Email :</td>
			<td><?php echo $email; ?></td>
		</tr>
		<tr><td colspan="3" align="center">Permanent Address</td></tr>
		<tr>
			<td>Housing location :</td>
			<td><?php echo $p_hloc; ?></td>
		</tr>
		<tr>
			<td>Street :</td>
			<td><?php echo $p_street; ?></td>
		</tr>
		<tr>
			<td>City :</td>
			<td><?php echo $p_city; ?></td>
		</tr>
		<tr>
			<td>Pincode :</td>
			<td><?php echo $p_pin; ?></td>
		</tr>
		<tr><td colspan="3" align="center">Residential Address</td></tr>
		<tr>
			<td>Housing location :</td>
			<td><?php echo $r_hloc; ?></td>
		</tr>
		<tr>
			<td>Street :</td>
			<td><?php echo $r_street; ?></td>
		</tr>
		<tr>
			<td>City :</td>
			<td><?php echo $r_city; ?></td>
		</tr>
		<tr>
			<td>Pincode :</td>
			<td><?php echo $r_pin; ?></td>
		</tr>
	</table>
</body>
</html>