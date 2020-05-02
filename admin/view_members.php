<?php
session_start();
require("../includes/connect.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}


$query = $db->query("SELECT * FROM members");

?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Members</h2>
			<?php
				while($row = $query->fetch_row()){
					$picture = "";
					if(file_exists("../members/".$row[0].".jpg")){
						$picture = "../members/".$row[0].".jpg";
					}else{
						if($row[4] == "Male"){
							$picture = "../images/default_member.jpg";
						}else{
							$picture = "../images/default_member_woman.jpg";
						}
					}
					
					echo "<div class='bigBox'>
							<img src='".$picture."' style='width:200px;height:200px;'>
							<table>
							<tr>
							<td><b>Name</b></td><td>".$row[1]."</td>
							<tr>
							<tr>
							<td><b>Position</b></td><td>".$row[2]."</td>
							<tr>
							<tr>
							<td><b>Farm</b></td><td>".$row[3]."</td>
							<tr>
							</table>
							<br />
							<a href='edit_member.php?id=".$row[0]."'><span id='btn'>Edit</span></a>
							<a href='delete_member.php?id=".$row[0]."' id='btn' onclick=' return confirm(\"Are you sure you want to delete this member?\")'><span>Delete</span></a>
							</div>";
				}
			?>
		</div>
	</div>
</body>
</html>