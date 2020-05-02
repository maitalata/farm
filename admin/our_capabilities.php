<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$capabilities= "";
	$data_check = new DataValidation();
	
	$capabilities = $data_check->validate($_POST['capabilities']);
	
	if($db->query("UPDATE capabilities SET capabilities='$capabilities'")){
		$error = "<span id='gd'>posted successfully</span>";
	}else{
		$error = "<span id='er'>cannot be posted for unknown reasons</span>";
	}
}

$query = $db->query("SELECT * FROM capabilities");
$row = $query->fetch_row()

?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Post Organisation Capabilities</h2>
			<?php echo $error; ?>
			<form action="" method="POST">
			<br >
			<textarea name="capabilities"><?php echo $row[1]; ?></textarea> <br /><br />
			<button type="submit"><i class="fa fa-paper-plane mini"></i> Post</button>
			</form>
		</div>
	</div>
</body>
</html>