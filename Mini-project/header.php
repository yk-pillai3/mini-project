<?php
	session_start();
	if ($_SESSION['type']=="admin") {
		echo "<h2>Hello Admin</h2>";
	}else{
		echo "<h2>Hello User</h2>";
	}
?>
<div align="right"><a href="logout.php">Logout <?php echo $_SESSION['name']; ?></a></div>