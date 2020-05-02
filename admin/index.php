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
		<a href="about_us.php"><div class="box">
			About Us Page<br >
			<i class="fa fa-question large"></i>
		</div></a>
		<a href="view_messages.php"><div class="box">
			View Messages<br >
			<i class="fa fa-envelope large"></i>
		</div></a>
		<a href="members.php"><div class="box">
			Members<br >
			<i class="fa fa-users large"></i>
		</div></a>
		<a href="settings.php"><div class="box">
			Settings<br >
			<i class="fa fa-gears large"></i>
		</div></a>
		<a href="our_capabilities.php"><div class="box">
			Our Capabilities<br >
			<i class="fa fa-briefcase large"></i>
		</div></a>
		<a href="news_update.php"><div class="box">
			News Update<br >
			<i class="fa fa-newspaper-o large"></i>
		</div></a>
		<a href="contact.php"><div class="box">
			Our Contact<br >
			<i class="fa fa-phone large"></i>
		</div></a>
		<a href="logout.php"><div class="box">
			Logout<br >
			<i class="fa fa-sign-out large"></i>
		</div></a>
	</div>
</body>
</html>