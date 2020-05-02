<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name= $position= $farm= $gender="";
	$data_check = new DataValidation();
	$name = $data_check->validate($_POST['name']);
	$position = $data_check->validate($_POST['position']);
	$farm = $data_check->validate($_POST['farm']);
	$gender = $data_check->validate($_POST['gender']);
	
	if($db->query("INSERT INTO members(name, position, farm, gender) VALUES('$name','$position','$farm','$gender')")){
		$error = "<span id='gd'>Member added successfully</span>";
		if(is_uploaded_file($_FILES['picture']['tmp_name'])){
			$query = $db->query("SELECT * FROM members ORDER BY id DESC");
			$row = $query->fetch_row();
			$filename = $row[0].".jpg";
			move_uploaded_file($_FILES['picture']['tmp_name'],"../members/".$filename);
		}
	}else{
		$error = "<span id='er'>Member cannot be added for unknown reasons</span>";
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
			Full Name<br />
			<input type="text" class="textBox" name="name"> <br />
			Position in Organisation <br />
			<input type="text" class="textBox" name="position"> <br />
			Farm Enterprise <br />
			<input type="text" class="textBox" name="farm"> <br />
			Gender <br />
			<select name="gender" class="checkBox">
			<option value="">Select Gender</option>
			<option value="Male">Male</option>
			<option value="Female">Female</option>
			</select> <br />
			Picture <br />
			<input type="file" class="textBox" name="picture"> <br /><br />
			<button type="submit"><i class="fa fa-sign-in mini"></i> Add Member</button>
			</form>
		</div>
	</div>
</body>
</html>