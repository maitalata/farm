<?php
require("includes/connect.inc.php");

$query = $db->query("SELECT * FROM about");
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
				<h2>About Us</h2>
				<b>Vision</b><br />
				<p><?php echo $row[1]; ?></p>
				<b>Mission</b><br />
				<p><?php echo $row[2]; ?></p>
				<b>Objectives</b><br />
				<p>
				<?php 
					$arr = explode('*', $row[3]);
					$count = 1;
					foreach($arr as $var){
						if(strlen($var) == 0)
							continue;
						echo $count.". ".$var."<br />";
						$count++;
					}
				?>
				</p>
			</div>
		</div>
	</div>
</body>
</html>