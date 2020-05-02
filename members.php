<?php
require("includes/connect.inc.php");

$query = $db->query("SELECT * FROM members");
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
				<h2>Members</h2>
				<?php
					while($row = $query->fetch_row()){
						$file = "";
						if(file_exists("members/".$row[0].".jpg")){
							$file = "members/".$row[0].".jpg";
						}else if($row[4] == "Male"){
							$file = "images/default_member.jpg";
						}
						else if($row[4] == "Female"){
							$file = "images/default_member_woman.jpg";
						}
						echo "<div style='display:inline-block;margin:30px;width:300px;'>
								<img src=".$file." style='height:200px;width:200px;border:2px solid black;'>
								<br /><b>".$row[1]."</b><br />
								".$row[2]."<br />
								".$row[3]."<br />
								</div>";
					}
				
				?>
			</div>
		</div>
	</div>
</body>
</html>