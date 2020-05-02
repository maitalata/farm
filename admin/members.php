<?php
session_start();

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}

?>
<?php require_once("../includes/dashboard_header.inc.php"); ?>
<body>
	<div>
		<?php require_once("../includes/dashboard_subheader.inc.php"); ?>
		<a href="add_member.php"><div class="box">
			Add A Member<br >
			<i class="fa fa-user-plus large"></i>
		</div></a>
		<a href="view_members.php"><div class="box">
			View Members<br >
			<i class="fa fa-users large"></i>
		</div></a>
	</div>
</body>
</html>