<?php
	session_start();
	include 'db.php';
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
		$errors=array();
		if (empty($_POST['luname'])) {
			$errors['luname1']="Your username field is empty";
		}
		if (empty($_POST['lpass'])) {
			$errors['lpass1']="Your password field is empty";
		}




		$sql="select uname,pass,type,pic_path from details";
		$result=$mysqli->query($sql);
			while ($row=$result->fetch_assoc()) {
				if ($row['uname']==$_POST['luname'] && $row['pass']==md5($_POST['lpass'])) {
					$_SESSION['name']=$row['uname'];
					$_SESSION['type']=$row['type'];
					if ($row['type']=="admin") {
						if (empty($errors)) {
							header("location:listing.php");
						}
						
					}else{
						$uname=urlencode(base64_encode($row['uname']));
						//if (empty($errors)) {
							header("location:view.php?view=$uname");
						//}
						
					}
				}else{
					//if (!empty($errors['luname1']) && !empty($errors['luname1'])) {
						$errors['both']="Your username or password doesnt match";
					//}
					
				}
			}	
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		fieldset{
			width: 50%;
		}
		p{
			color: red;
		}
	</style>
</head>
<body >
	<form method="post" action="index.php">
		<p><?php if (isset($errors['both'])) {
			echo $errors['both'];
		} ?></p>
		<fieldset>
		<legend>Login</legend>
		Username:<input type="text" name="luname" autofocus><br>
		<p><?php if (isset($errors['luname1'])) {
			echo $errors['luname1'];
		} ?></p>
		Password:<input type="password" name="lpass" ><br>
		<p><?php if (isset($errors['lpass1'])) {
			echo $errors['lpass1'];
		} ?></p>
		<input type="submit" name="submit" value="Login">
		<p style="color: blue">If not registered <a href="signup.php">click here</a></p>
	</fieldset>
	</form>
</body>
</html>
