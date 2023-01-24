<html>
<style type="text/css">
.DIFFUSEtxt {
	color: #ff9900;
	text-shadow: 0 1px 0 #999999, 0 10px 25px rgba(0,0,0,0.1), 10px 20px 5px rgba(0,0,0,0.0), -10px 20px 5px rgba(0,0,0,0.0);
}
.h1 { color: #4d2600; font-family: 'Trocchi', serif; font-size: 45px; font-weight: normal; line-height: 48px; margin: 0; }

.p { color: #cc6600; font-family: 'Source Sans Pro', sans-serif; font-size: 18px; line-height: 32px; margin: 0 0 24px; }
</style>
<?php
	include('C:\xampp\htdocs\templates\csc350project\db_connect.php');
	include('C:\xampp\htdocs\templates\csc350project\header.php');


?>

<br><br>
<div class="col s6 md3">
	<div class="card z-depth-4">
		<div class="card-content center">

<?php
	if($email == '' || $email == null){
		?><a href="login.php" button type="button">
			<?php echo "<b>To view your dashboard, please sign in.</b>";?></a></button>
			<?php
	}
	else if($email != ''){
		$email = $_SESSION['email'];
		$lastName = $_SESSION['lastName'];
		$firstName = $_SESSION['firstName'];
		$Two_Factor = $_SESSION['Two_Factor'];
		?>
		
		<a class="DIFFUSEtxt" style="font-size:70px"><b>Dashboard</b></a><br><br>

		<a class="h1" style="font-size:30px">First Name:</a>
		<a class="p" style="font-size:25"><?php echo $firstName; ?><br></a>

		<a class="h1" style="font-size:30px">Last Name:</a>
		<a class="p" style="font-size:25"><?php echo $lastName; ?><br></a>

		<a class="h1" style="font-size:30px">Email:</a>
		<a class="p" style="font-size:25"><?php echo $email; ?><br></a><br>

<?php
	if($Two_Factor == '0' || $Two_Factor == null){
		echo "You are not signed up for 2-Factor Authentication. <a href = generate.php>Sign up now.</a>";
	}
	else{
		echo "You're already signed up for 2-Factor Authentication.";
	}
	}
?>
</html>