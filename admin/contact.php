<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$office= $phone_numbers= $email="";
	$data_check = new DataValidation();
	
	$office = $data_check->validate($_POST['office']);
	$phone_numbers = $data_check->validate($_POST['numbers']);
	$email = $data_check->validate($_POST['email']);
	
	if($db->query("UPDATE contact SET office='$office', phone='$phone_numbers', email='$email'")){
		$error = "<span id='gd'>posted successfully</span>";
		
	}else{
		$error = "<span id='er'>cannot be posted for unknown reasons</span>";
	}
}


$query = $db->query("SELECT * FROM contact");
$row = $query->fetch_row();
?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Our Contact Information</h2>
			<?php echo $error; ?>
			<form action="" method="POST">
			Office Address<br />
			<textarea name="office" id="smlTxtArea"><?php echo $row[1]; ?></textarea> <br />
			Phone Numbers<br />
			<textarea name="numbers" id="smlTxtArea"><?php echo $row[2]; ?></textarea> <br />
			Email <br >
			<textarea name="email" id="smlTxtArea"><?php echo $row[3]; ?></textarea> <br /><br />
			<button type="submit"><i class="fa fa-paper-plane mini"></i> Update</button>
			</form>
		</div>
	</div>
</body>
</html>