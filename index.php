<?php
//header("Location: shutdown.php");
require("includes/connect.inc.php");

$query = $db->query("SELECT * FROM news");
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
			<a href="about_us.php"><div class="box">
				About Us<br />
				<i class="fa fa-question-circle large"></i>
			</div></a>
			<a href="contact_us.php"><div class="box">
				Contact Us<br />
				<i class="fa fa-phone large"></i>
			</div></a>
			<a href="members.php"><div class="box">
				Members <br />
				<i class="fa fa-users large"></i>
			</div></a>
			<a href="page_under_construction.php"><div class="box">
				Gallery<br />
				<i class="fa fa-video-camera large"></i>
			</div></a>
			<a href="capabilities"><div class="box">
				Our Capabilities <br />
				<i class="fa fa-briefcase large"></i>
			</div></a>
			<a href="order.php"><div class="box">
				Place an Order <br />
				<i class="fa fa-credit-card large"></i>
			</div></a>
		</div>
	</div>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2><?php echo $row[1]; ?></h2>
    </div>
    <div class="modal-body">
      <p><?php echo $row[2]; ?></p>
    </div>
    
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
function show() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

setTimeout(show, 8000);
</script>

</body>
</html>