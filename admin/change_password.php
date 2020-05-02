<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$user = $_SESSION['user'];

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$old_password= $new_password= $retype= "";
	$data_check = new DataValidation();
	
	$old_password = $data_check->validate($_POST['old_password']);
	$new_password = $data_check->validate($_POST['new_password']);
	$retype = $data_check->validate($_POST['retype']);
	
	if($data_check->emptyCheck($old_password, $new_password, $retype)){
		$old_password = sha1($old_password);
		$query = $db->query("SELECT * FROM administrators WHERE username='$user' AND password='$old_password'");
		if($query->num_rows == 1){
			if(strlen($new_password) >= 8){
				if($new_password === $retype){
					$new_password = sha1($new_password);
					if($db->query("UPDATE administrators SET password='$new_password' WHERE username='$user'")){
						$error = "<span id='gd'>password changed successfully</span>";
					}else{
						$error = "<span id='er'>password cannot be changed for unknown reason</span>";
					}
				}else{
					$error = "<span id='er'>retyped password did not match with the new password</span>";
				}
			}else{
				$error = "<span id='er'>new password must be atleast 8 characters</span>";
			}
		}else{
			$error = "<span id='er'>incorrect old password</span>";
		}
	}else{
		$error = "<span id='er'>all fields must be filled</span>";
	}
}

?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Add New Member</h2>
			<?php echo $error; ?>
			<form action="" enctype="multipart/form-data" method="POST">
			Old Password<br />
			<input type="password" class="textBox" name="old_password"> <br />
			New Password<br />
			<input type="password" class="textBox" name="new_password"> <br />
			Retype New Password <br />
			<input type="password" class="textBox" name="retype"> <br /><br />
			<button type="submit"><i class="fa fa-sign-in mini"></i> Change Password</button>
			</form>
		</div>
	</div>
</body>
</html>