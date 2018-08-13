<?php
	session_start();
	$_SESSION['message']="";
	include 'db.php';
?>
<?php	
$errors=array();
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
		
		if ($_POST['pass']==$_POST['cpass']) {
			$fname=$mysqli->real_escape_string($_POST['fname']);
			if (empty($fname)) {
				$errors['fname1']="First name cannot be empty";
			}elseif (!preg_match("/^[a-zA-Z]*$/",$fname)) {
     			$errors['fname1'] = "Only letters are allowed"; 
    		}
			$lname=$mysqli->real_escape_string($_POST['lname']);
			if (empty($lname)) {
				$errors['lname1']="Last name cannot be empty";
			}elseif (!preg_match("/^[a-zA-Z]*$/",$lname)) {
     			$errors['lname1'] = "Only letters are allowed"; 
    		}
			$contact=$mysqli->real_escape_string($_POST['contact']);
			if (empty($contact)) {
				$errors['contact1']="Contact cannot be empty";
			}elseif (!preg_match("/^[0-9]{10}$/",$contact)) {
     			$errors['contact1'] = "Only 10 digit numbers are allowed"; 
    		}
			$gender=$_POST['gender'];
			$date=$mysqli->real_escape_string($_POST['date']);
			echo $date;
			if (empty($date)) {
				$errors['date1']="Date cannot be empty";
			}elseif ($date > date("Y-m-d")) {
     			$errors['date1'] = "Enter a valid date"; 
    		}
			$email=$mysqli->real_escape_string($_POST['email']);

			if (empty($email)) {
    			$errors['email1'] = "Email is required";
 			} else {
    		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     			$errors['email1'] = "Invalid email format"; 
    		}
  			}

			$uname=$mysqli->real_escape_string($_POST['uname']);
			if (empty($uname)) {
				$errors['uname1']="Username cannot be empty";
			}elseif (!preg_match("/^[a-zA-Z]*$/",$uname)) {
     			$errors['uname1'] = "Only letters are allowed"; 
     		}
			$pass=md5($_POST['pass']);
			if (empty($pass)) {
				$errors['pass1'] = "Password cannot be empty"; 
			}
			if (empty($_POST['cpass'])) {
				$errors['cpass1'] = "Please confirm password"; 
			}
			$p_hloc=$mysqli->real_escape_string($_POST['p_hloc']);
			if (empty($p_hloc)) {
				$errors['p_hloc'] = "Please enter the location"; 
			}
			$p_street=$mysqli->real_escape_string($_POST['p_street']);
			if (empty($p_street)) {
				$errors['p_street'] = "Please enter the street name"; 
			}
			$p_city=$mysqli->real_escape_string($_POST['p_city']);
			if (empty($p_city)) {
				$errors['p_city'] = "Please enter the City name"; 
			}
			$p_pin=$mysqli->real_escape_string($_POST['p_pin']);
			if (empty($p_pin)) {
				$errors['p_pin'] = "Please enter the pin code"; 
			}elseif (!preg_match("/^[0-9]{6}$/", $p_pin)) {
					$errors['p_pin'] = "Please enter valid pincode"; 
				}
			if (isset($_POST['checkbox'])) {
				$r_hloc=$mysqli->real_escape_string($_POST['r_hloc']);
				if (empty($r_hloc)) {
				$errors['r_hloc'] = "Please enter the location"; 
				}
				$r_street=$mysqli->real_escape_string($_POST['r_street']);
				if (empty($r_street)) {
				$errors['r_street'] = "Please enter the street name"; 
				}
				$r_city=$mysqli->real_escape_string($_POST['r_city']);
				if (empty($r_city)) {
				$errors['r_city'] = "Please enter the City name"; 
				}
				$r_pin=$mysqli->real_escape_string($_POST['r_pin']);
				if (empty($r_pin)) {
				$errors['r_pin'] = "Please enter the pincode"; 
				}elseif (!preg_match("/^[0-9]{6}$/", $r_pin)) {
					$errors['r_pin'] = "Please enter valid pincode"; 
				}
			}else{
				$r_hloc=$mysqli->real_escape_string($_POST['p_hloc']);
				$r_street=$mysqli->real_escape_string($_POST['p_street']);
				$r_city=$mysqli->real_escape_string($_POST['p_city']);
				$r_pin=$mysqli->real_escape_string($_POST['p_pin']);
			}
			$pic_path=$mysqli->real_escape_string('uploads/'.$_FILES['pic']['name']);
				if (preg_match('/image/', $_FILES['pic']['type'])) {
					if (copy($_FILES['pic']['tmp_name'], $pic_path)) {
						//echo "HIIIII";
						$sql="INSERT INTO details(type, fname, lname, contact, gender, date, email, uname, pass, p_hloc, p_street, p_city, p_pin, r_hloc, r_street, r_city, r_pin, pic_path) VALUES ('user','$fname','$lname','$contact','$gender','$date','$email','$uname','$pass','$p_hloc','$p_street','$p_city','$p_pin','$r_hloc','$r_street','$r_city','$r_pin','$pic_path')";
						if ($mysqli->query($sql)===true) {
							//$_SESSION['message']="User registered";
							if (empty($errors)) {
								header("location:index.php");
							}
						}else{
							echo "Error: " . $sql . "<br>" . $mysqli->error;
							$errors['pic']="Could not add to database";
						}
					}else{
						$errors['pic']="Profile pic could not be uploaded";
					}
				}else{
					if (empty($_POST['pic'])) {
						$errors['pic']="Please upload a profile picture";
					}else{
						$errors['pic']="Only .gif , .jpg , .png extensions are allowed";
				}
				}

		}else{
			$errors['cpass1']="Password do not match";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<style type="text/css">
		font{
			color: red;
		}
	</style>
</head>
<body>
	<fieldset style="width: 50%">
		<!-- <?php echo $_SESSION['message']; ?> -->
		<legend>SIGN UP</legend>
		
		<form method="post" action="signup.php" enctype="multipart/form-data">
			
			First name:<input type="text" name="fname"><font><?php if(isset($errors['fname1'])) {echo $errors['fname1'];} ?></font><br><br>
			Last name:<input type="text" name="lname"><font><?php if(isset($errors['lname1'])) {echo $errors['lname1'];} ?></font><br><br>
			Profile picture:<input type="file" name="pic" accept="image/*"><font><?php if(isset($errors['pic'])) {echo $errors['pic'];} ?></font><br><br>
			Contact no:<input type="text" name="contact"><font><?php if(isset($errors['contact1'])) {echo $errors['contact1'];} ?></font><br><br>
			Gender:<input type="radio" name="gender" value="male" checked>Male
				<input type="radio" name="gender" value="female">Female
				<input type="radio" name="gender" value="other">Other<!-- <font><?php if(isset($errors['gender1'])) {echo $errors['gender1'];} ?></font> --><br><br>
			Date of birth:<input type="date" name="date"><font><?php if(isset($errors['date1'])) {echo $errors['date1'];} ?></font><br><br>
			Email ID:<input type="text" name="email"><font><?php if(isset($errors['email1'])) {echo $errors['email1'];} ?></font><br><br>
			Username:<input type="text" name="uname" ><font><?php if(isset($errors['uname1'])) {echo $errors['uname1'];} ?></font><br><br>
			Password:<input type="password" name="pass" ><font><?php if(isset($errors['pass1'])) {echo $errors['pass1'];} ?></font><br><br>
			Confirm Password:<input type="password" name="cpass"><font><?php if(isset($errors['cpass1'])) {echo $errors['cpass1'];} ?></font><br><br>
		---------------------Permanent Address----------------------<br><br>
			Housing location:<input type="text" name="p_hloc"><font><?php if(isset($errors['p_hloc'])) {echo $errors['p_hloc'];} ?></font><br><br>
			Street:<input type="text" name="p_street"><font><?php if(isset($errors['p_street'])) {echo $errors['p_street'];} ?></font><br><br>
			City:<input type="text" name="p_city"><font><?php if(isset($errors['p_city'])) {echo $errors['p_city'];} ?></font><br><br>
			Pin code:<input type="text" name="p_pin"><font><?php if(isset($errors['p_pin'])) {echo $errors['p_pin'];} ?></font><br><br>
			<input type="checkbox" name="checkbox" id="checkbox">Check if residential address is different than the above mentioned address<br><br>
			<div id="r-address">
				-------------------Residential Address----------------------<br><br>
				Housing location:<input type="text" name="r_hloc"><font><?php if(isset($errors['r_hloc'])) {echo $errors['r_hloc'];} ?></font><br><br>
				Street:<input type="text" name="r_street"><font><?php if(isset($errors['r_street'])) {echo $errors['r_street'];} ?></font><br><br>
				City:<input type="text" name="r_city"><font><?php if(isset($errors['r_city'])) {echo $errors['r_city'];} ?></font><br><br>
				Pin code:<input type="text" name="r_pin"><font><?php if(isset($errors['r_pin'])) {echo $errors['r_pin'];} ?></font><br><br>
				
			</div>
			
			<input type="submit" name="submit" value="Sign Up">
		</form>
	</fieldset>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script type="text/javascript">
				$(document).ready(function () {
					$('#r-address').hide();
					$('#checkbox').click(function(){
        			$('#r-address').show();
    				
					});
				});
			</script>
</body>
</html>