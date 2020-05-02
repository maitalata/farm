<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

if(!isset($_GET['id'])){
	header("Location: index.php");
}

$id = $_GET['id'];

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name= $position= $farm= $gender="";
	$data_check = new DataValidation();
	
	$name = $data_check->validate($_POST['name']);
	$position = $data_check->validate($_POST['position']);
	$farm = $data_check->validate($_POST['farm']);
	$gender = $data_check->validate($_POST['gender']);
	
	if($db->query("UPDATE members SET name='$name', position='$position', farm='$farm', gender='$gender' WHERE id='$id'")){
		$error = "<span id='gd'>updated successfully</span>";
		if(is_uploaded_file($_FILES['picture']['tmp_name'])){
			$filename = $id.".jpg";
			move_uploaded_file($_FILES['picture']['tmp_name'],"../members/".$filename);
		}
	}else{
		$error = "<span id='er'>Member details cannot be updated for unknown reason</span>";
	}
}

$query = $db->query("SELECT * FROM members WHERE id='$id'");
$row = $query->fetch_row();
?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Add New Member</h2>
			<?php echo $error; ?>
			<form action="" enctype="multipart/form-data" method="POST">
			Full Name<br />
			<input type="text" class="textBox" name="name" value="<?php echo $row[1]; ?>" > <br />
			Position in Organisation <br />
			<input type="text" class="textBox" name="position" value="<?php echo $row[2]; ?>" > <br />
			Farm Enterprise <br />
			<input type="text" class="textBox" name="farm" value="<?php echo $row[3]; ?>" > <br />
			Gender <br />
			<select name="gender" class="checkBox">
			<option value="">Select Gender</option>
			<option value="Male" <?php echo ($row[4] == "Male")?"selected":""; ?>>Male</option>
			<option value="Female" <?php echo ($row[4] == "Female")?"selected":""; ?>>Female</option>
			</select> <br />
			Picture <br />
			<input type="file" class="textBox" name="picture"><br /><br />
			<button type="submit"><i class="fa fa-sign-in mini"></i> Update Member</button>
			</form>
		</div>
	</div>
</body>
</html>