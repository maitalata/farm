<?php
require("includes/connect.inc.php");

$query = $db->query("SELECT * FROM capabilities");
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
				<h2>Our Capabilities</h2>
				<?php echo $row[1]; ?>
				</p>
			</div>
		</div>
	</div>
</body>
</html>