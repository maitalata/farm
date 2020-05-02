<?php
session_start();
require("../includes/connect.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

$pageSize = 10;

if(isset($_GET['recordstart']))
{
	$recordStart = (int)$_GET['recordstart'];
}
else
{
	$recordStart = 0;
}

function pagination($recordStart, $pageSize, $totalRow)
{
	if($recordStart > 0)
	{
		$prev = $recordStart - $pageSize;
		echo "<a href='view_messages.php?recordstart=$prev'>Prev. Page</a> |";
	}
	
	if ($totalRow > ($recordStart + $pageSize))
	{
		$next = $recordStart + $pageSize;
		echo " <a href='view_messages.php?recordstart=$next'>Next Page</a>";
	}
}
?>

<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<div class="container" style="font-size:22px;">
			<h2>Messages</h2>
				<?php
					$queryTest = $db->query("SELECT * FROM messages");
					$totalRow = $queryTest->num_rows;
					
					
					$query = $db->query("SELECT * FROM messages ORDER BY id DESC  LIMIT $recordStart, $pageSize");
					
					if($query->num_rows == 0)
					{
						echo "<div id='bg'>There are no items check back later!</div>";
					}
					else
					{
						while($row = $query->fetch_row()){
							echo "<div class='bigBox'>
									<table>
									<tr>
									<td><b>Sender's Name</b></td><td>".$row[1]."</td>
									</tr>
									".(!empty($row[2])?"<tr><td><b>Sender's Email</b></td><td>".$row[2]."</td></tr>":"")."
									".(!empty($row[3])?"<tr><td><b>Sender's Phone</b></td><td>".$row[3]."</td></tr>":"")."
									</table>
									<h4>Message</h4>
									<p>".$row[4]."</p>
									</div>";
						}
					}
					echo "<div id='pageLnk'>";
					pagination($recordStart, $pageSize, $totalRow);
			?>
		</div>
	</div>
</body>
</html>