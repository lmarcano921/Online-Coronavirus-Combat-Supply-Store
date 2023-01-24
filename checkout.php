<?php
	
	include('C:\xampp\htdocs\templates\csc350project\db_connect.php');			
	include('C:\xampp\htdocs\templates\csc350project\header.php');
	$firstName = $_SESSION['firstName'];
	$lastName = $_SESSION['lastName'];
	$total = $_SESSION['total'];
	unset($_SESSION['total']);
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<header class="w3-container w3-blue w3-center" style="padding:128px 16px">
	<h3 class="w3-margin w3-jumbo"><?php echo "Hello, " . $firstName . " " . $lastName . "!";?></h3>
  <h1 class="w3-margin w3-jumbo">Your order has been processed.</h1>
  <p class="w3-xlarge">Total Due: $<?php echo $total?></p>
  <a href = "index.php">
  <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Return Home</button></a>
</header>

<?php
	
?>
