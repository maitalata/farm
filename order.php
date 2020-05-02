<?php
require("includes/connect.inc.php");
require("includes/classes.inc.php");

$error= "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$name= $phone= $email= $country= $state= $address= $order= $delivery= "";
	$data_check = new DataValidation();
	
	$name = $data_check->validate($_POST['name']);
	$phone = $data_check->validate($_POST['phone']);
	$email = $data_check->validate($_POST['email']);
	
	if($_POST['origin'] == 'Yes'){
		$country = "Nigeria";
		$state = $data_check->validate($_POST['state']);
	}else{
		$country = $data_check->validate($_POST['country']);
	}
	
	$address = $data_check->validate($_POST['address']);
	$order = $data_check->validate($_POST['ord']);
	$delivery = $data_check->validate($_POST['delivery']);
	
	if($data_check->emptyCheck($name, $phone, $country, $address, $order)){
		if($db->query("INSERT INTO orders(name, phone, email, country, state, address, ord, delivery) VALUES ('$name','$phone',
						'$email','$country','$state','$address','$order','$delivery')")){
			$error = "<span id='gd'>Order sent successfully, thank you</span>";
		}else{
			$error = "<span id='er'>Order cannot be sent for unknown reason</span>";
		}
	}else{
		$error = "<span id='er'>You must provide your name, phone number, country, address and order details</span>";
	}
}

$query = $db->query("SELECT * FROM contact");
$row = $query->fetch_row();
?>
<!DOCTYPE html>
<html>
<head>
<title>Professional Farmers Association of Kano & Jigawa</title>
<?php require_once("includes/outer_header.inc.php"); ?>
<script>
	function locationSpawn(arg){
		if(arg == 'Yes'){
			document.getElementById('location').innerHTML = "Select State<br />"+
															"<select name='state' required>"+
															"<option value=''>Select</option>"+
															"<option value='Abia'>Abia</option>"+
															"<option value='Abuja (F.C.T)'>Abuja (F.C.T)</option>"+
															"<option value='Adamawa'>Adamawa</option>"+
															"<option value='Akwa Ibom'>Akwa Ibom</option>"+
															"<option value='Anambra'>Anambra</option>"+
															"<option value='Bauchi'>Bauchi</option>"+
															"<option value='Bayelsa'>Bayelsa</option>"+
															"<option value='Benue'>Benue</option>"+
															"<option value='Borno'>Borno</option>"+
															"<option value='Cross Rivers'>Cross Rivers</option>"+
															"<option value='Ebonyi'>Ebonyi</option>"+
															"<option value='Edo'>Edo</option>"+
															"<option value='Ekiti'>Ekiti</option>"+
															"<option value='Enugu'>Enugu</option>"+
															"<option value='Delta'>Delta</option>"+
															"<option value='Gombe'>Gombe</option>"+
															"<option value='Imo'>Imo</option>"+
															"<option value='Jigawa'>Jigawa</option>"+
															"<option value='Kaduna'>Kaduna</option>"+
															"<option value='Kano'>Kano</option>"+
															"<option value='Katsina'>Katsina</option>"+
															"<option value='Kebbi'>Kebbi</option>"+
															"<option value='Kogi'>Kogi</option>"+
															"<option value='Kwara'>Kwara</option>"+
															"<option value='Lagos'>Lagos</option>"+
															"<option value='Nassarawa'>Nassarawa</option>"+
															"<option value='Niger'>Niger</option>"+
															"<option value='Ogun'>Ogun</option>"+
															"<option value='Ondo'>Ondo</option>"+
															"<option value='Osun'>Osun</option>"+
															"<option value='Oyo'>Oyo</option>"+
															"<option value='Plateau'>Plateau</option>"+
															"<option value='Rivers'>Rivers</option>"+
															"<option value='Sokoto'>Sokoto</option>"+
															"<option value='Taraba'>Taraba</option>"+
															"<option value='Yobe'>Yobe</option>"+
															"<option value='Zamfara'>Zamfara</option>"+
															"</select><br />"+
															"Home Address<br />"+
															"<input type='text' name='address' required>";
		}else if(arg == 'No'){
			document.getElementById('location').innerHTML = "Country<br />"+
															"<input type='text' name='country' list='closeCountries' required><br />"+
															"State/Region & Address<br />"+
															"<input type='text' name='address' required>";
		}else
			document.getElementById('location').innerHTML = "";
	}
</script>
</head>
<body>
	<datalist id="closeCountries">
		<option value="Niger Republic">
		<option value="Chad">
		<option value="Benin Republic">
		<option value="Togo">
		<option value="Ghana">
		<option value="Cameroon">
	</datalist>
	<?php require_once("includes/inner_header.inc.php"); ?>
	<div class="outerContainer">
		<div class="container">
			<div class="contentPane">
				<h2>Give us an Order</h2>
				<?php echo $error; ?>
				<form action="" method="POST">
				Your Name<br />
				<input type="text" name="name" required><br />
				Your Phone Number<br />
				<input type="text" name="phone" required><br />
				Email (If Available)<br />
				<input type="text" name="email"><br />
				Are you a Nigerian?<br />
				<select name="origin" onchange="locationSpawn(this.value)" required>
				<option value="">Select</option>
				<option value="Yes">Yes</option>
				<option value="No">No</option>
				</select>
				<br />
				<span id="location"></span><br />
				Order Details (give detailed description of what you want and quantity)<br />
				<textarea name="ord" required></textarea><br />
				Delivery Address (leave the field empty if you plan to come and claim your order)<br />
				<input type="text" name="delivery"><br /><br />
				<button type="submit"><i class="fa fa-paper-plane small"></i> Send Order</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>