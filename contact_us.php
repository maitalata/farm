<?php
require("includes/connect.inc.php");
require("includes/classes.inc.php");

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name= $email= $phone= $message= "";
	$data_check = new DataValidation();
	
	$name = $data_check->validate($_POST['name']);
	$email = $data_check->validate($_POST['email']);
	$phone = $data_check->validate($_POST['phone']);
	$message = $data_check->validate($_POST['message']);
	if($data_check->emptyCheck($name, $message)){
		if($db->query("INSERT INTO messages(name, email, phone, message) VALUES ('$name','$email','$phone','$message')")){
			$error = "<span id='gd'>Message sent successfully, thank you</span>";
		}else{
			$error = "<span id='er'>Message cannot be sent for unknown reason</span>";
		}
	}else{
		$error = "<span id='er'>You must provide your name and message to sent</span>";
	}
}

$query = $db->query("SELECT * FROM contact");
$row = $query->fetch_row();
?>
<!DOCTYPE html>
<html>
<head>
<title>Professional Farmers Association of Kano & Jigawa</title>
<?php require_once("includes/outer_header.inc.php"); ?>
</head>
<body>
	<?php require_once("includes/inner_header.inc.php"); ?>
	<div class="outerContainer">
		<div class="container">
			<div class="contentPane">
				<h2>Contact Information</h2>
				<b>Office</b><br />
				<?php echo $row[1]; ?><br /><br />
				<b>Phone</b><br />
				<?php echo $row[2]; ?><br /><br />
				<b>Email</b><br />
				<?php echo $row[3]; ?>
				<h2>Send Us Message Now</h2>
				<?php echo $error; ?>
				<form action="" method="POST">
				Your Name<br />
				<input type="text" name="name" required><br />
				Your Email<br />
				<input type="text" name="email"><br />
				Your Phone Number<br />
				<input type="text" name="phone"><br />
				Your Message<br />
				<textarea name="message" required></textarea><br />
				<button type="submit"><i class="fa fa-paper-plane small"></i> Send Message</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>