<?php
session_start();
require("../includes/connect.inc.php");

if(!isset($_SESSION['admin_logged'])){
	header("Location: login.php");
}


if(!isset($_GET['id'])){
	header("Location: index.php");
}

$id = $_GET['id'];

$db->query("DELETE FROM members WHERE id='$id'");
unlink("../members/".$id.".jpg");

header("Location: view_members.php");
?>