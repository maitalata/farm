<?php
session_start();
require("../includes/connect.inc.php");
require("../includes/classes.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$title= $body="";
	$data_check = new DataValidation();
	$title = $data_check->validate($_POST['title']);
	$body = $data_check->validate($_POST['body']);
	
	if($db->query("UPDATE news SET title='$title', body='$body'")){
		$error = "<span id='gd'>posted successfully</span>";
		
	}else{
		$error = "<span id='er'>cannot be posted for unknown reasons</span>";
	}
	
}


$query = $db->query("SELECT * FROM news");
$row = $query->fetch_row();
?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Post News Update</h2>
			<?php echo $error; ?>
			<form action="" method="POST">
			News Title<br />
			<input type="text" class="textBox" name="title" value="<?php echo $row[1]; ?>"> <br />
			News Body <br >
			<textarea name="body"><?php echo $row[2]; ?></textarea> <br /><br />
			<button type="submit"><i class="fa fa-paper-plane mini"></i> Post News</button>
			</form>
		</div>
	</div>
</body>
</html>