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
		<a href="add_administrator.php"><div class="box">
			Add Administrator<br >
			<i class="fa fa-user-plus large"></i>
		</div></a>
		<a href="change_password.php"><div class="box">
			Change Password<br >
			<i class="fa fa-key large"></i>
		</div></a>
	</div>
</body>
</html>