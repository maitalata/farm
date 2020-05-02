<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name= $username= $password= $retype="";
	$data_check = new DataValidation();
	
	$name = $data_check->validate($_POST['name']);
	$username = $data_check->validate($_POST['username']);
	$password = $data_check->validate($_POST['password']);
	$retype = $data_check->validate($_POST['retype']);
	
	if($data_check->emptyCheck($name, $username, $password, $retype)){
		if(strlen($password) > 8){
			if($password === $retype){
				$password = sha1($password);
				$query = $db->query("SELECT * FROM administrators WHERE username='$username'");
				if($query->num_rows != 1){
					if($db->query("INSERT INTO administrators(name, username, password) VALUES('$name','$username','$password')")){
						$error = "<span id='gd'>Administrator added successfully</span>";
					}else{
						$error = "<span id='er'>Administrator cannot be added for unknown reasons</span>";
					}
				}else{
					$error = "<span id='er'>error! username is already in use by another administrator</span>";
				}
			}else{
				$error = "<span id='er'>Retyped password did not match with the password provided</span>";
			}
		}else{
			$error = "<span id='er'>Password must be at least 8 characters</span>";
		}
	}else{
		$error = "<span id='er'>All fields must be filled</span>";
	}
}

?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Add New Website Administrator</h2>
			<?php echo $error; ?>
			<form action="" enctype="multipart/form-data" method="POST">
			Full Name<br />
			<input type="text" class="textBox" name="name"> <br />
			Username<br />
			<input type="text" class="textBox" name="username"> <br />
			Password <br />
			<input type="password" class="textBox" name="password"> <br />
			Retype Password <br />
			<input type="password" class="textBox" name="retype"> <br /><br />
			<button type="submit"><i class="fa fa-paper-plane mini"></i> Add Administrator</button>
			</form>
		</div>
	</div>
</body>
</html>