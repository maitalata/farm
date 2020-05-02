<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$username= $password= "";
	$data_check = new DataValidation();
	
	$username = $data_check->validate($_POST['username']);
	$password = $data_check->validate($_POST['password']);
	
	$password = sha1($password);
	$query = $db->query("SELECT * FROM administrators WHERE username='$username' AND password='$password'");
	
	if($query->num_rows == 1){
		$row = $query->fetch_row();
		$_SESSION['admin_logged'] = true;
		$_SESSION['user'] = $row[2];
		header("Location: index.php");
	}else{
		$error = "<span id='er'>incorrect username or password</span>";
	}
}

?>
<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div class="loginBox">
		<h2>Administrator Login</h2>
		<?php echo $error; ?>
		<form action="" method="POST">
		<table>
		<tr>
		<td><i class="fa fa-user midi"></i></td><td><input type="text" name="username" placeholder="Username" ></td>
		</tr>
		<tr>
		<td><i class="fa fa-lock midi"></i></td><td><input type="Password" name="password" placeholder="Password"></td>
		</tr>
		</table>
		<button type="submit"><i class="fa fa-sign-in mini"></i> Login</button>
		</form>
		<br />
	</div>
</body>
</html>