<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$error= "";

$query = $db->query("SELECT * FROM about");
$row = $query->fetch_row();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$vision= $mission= $objectives= "";
	$data_check = new DataValidation();
	
	$vision = $data_check->validate($_POST['vision']);
	$mission = $data_check->validate($_POST['mission']);
	$objectives = $data_check->validate($_POST['objectives']);
	
	if($data_check->emptyCheck($vision, $mission, $objectives)){
		if($db->query("UPDATE about set vision='$vision', mission='$mission', objectives='$objectives'")){
			$error = "Updated successfully";
		}else{
			$error = "Data cannot be update for unknown reason";
		}
	}else{
		$error= "All fields must be filled";
	}
}

?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>About Us Page</h2>
			<?php echo $error; ?>
			<form action="" method="POST">
			Vision <br />
			<textarea name="vision" style="height:55px;"><?php echo $row[1]; ?></textarea><br />
			Mission <br />
			<textarea name="mission" style="height:55px;"><?php echo $row[2]; ?></textarea> <br />
			Objectives(put asterisk(*) at the beginning of each objective)<br />
			<textarea name="objectives"><?php echo $row[3]; ?></textarea><br /><br />
			<button type="submit"><i class="fa fa-sign-in mini"></i> Post News</button>
			</form>
		</div>
	</div>
</body>
</html>