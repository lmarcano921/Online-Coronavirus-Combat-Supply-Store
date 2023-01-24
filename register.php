<?php 
include('C:\xampp\htdocs\templates\csc350project\db_connect.php');				//change directory
include('C:\xampp\htdocs\templates\csc350project\header.php'); 					//change directory

$errors = array('email' => '', 'password' => '', 'confirm_password' => '', 'firstName' => '', 'lastName' => '');
$Two_Factor = '0';
$email = $password = $confirm_password = $firstName = $lastName = $ID = '';
$myEmail = $myPassword = $myConfirmPassword = '';

if(isset($_POST['submit'])){

	
	$myEmail = $_POST['email'];
	$myPassword = $_POST['password'];
	$myConfirmPassword = $_POST['confirm_password'];
	$isTrue = $checkPass = $checkConfirm = false;
	
	$myEmail = stripslashes($myEmail);
	$myPassword = stripslashes($myPassword);
	$myConfirmPassword = stripslashes($myConfirmPassword);
	
	if(empty($_POST['email'])){
			$errors['email'] = '*An email is required';
	} 
	else{
		$email = $_POST['email'];
		$isTrue = true;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email'] = '*Email must be a valid email address';
		}
	}
	if(empty($_POST['firstName'])){
		$errors['firstName'] = '*A first name is required';
	} 
	if(empty($_POST['lastName'])){
		$errors['lastName'] = '*A last name is required';
	} 
	if(empty($_POST['password'])){
		$errors['password'] = '*A password is required';
	} 

	if(empty($_POST['confirm_password'])){
		$errors['confirm_password'] = '*Field is blank';
	}
		
		if(($_POST['password'] == $_POST['confirm_password']) && ($isTrue == true) && (!empty($_POST['confirm_password']) && !empty($_POST['password']) && !empty($_POST['firstName']) && !empty($_POST['lastName']))){
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				$password = $_POST['password'];
				$confirm_password = $_POST['confirm_password'];
				$insert = "insert into users (email, firstName, lastName, password, Two_Factor) values ('$email','$firstName','$lastName','$password', '$Two_Factor')";
				
				$r = mysqli_query($con,$insert) or die('Cannot insert: ');
				if($r){
					$query = "SELECT ID, email, firstName, lastName, password, Two_Factor FROM users WHERE email = '$myEmail' and password = '$myPassword'";
					$result = mysqli_query($con, $query);
					$count = mysqli_num_rows($result);
					
					if ($result = $con->query($query)) {    
						while ($row = $result->fetch_object()) {
							$ID = $row->ID;
						}
						$_SESSION['ID'] = $ID;
						$result->close();
					}
					$_SESSION['ID'] = $ID;
					$_SESSION['Two_Factor'] = $Two_Factor;
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['firstName'] = $_POST['firstName'];
					$_SESSION['lastName'] = $_POST['lastName'];
					echo "success.<br>";
					header('Location: 2-Step-Verification.php');
				}
				else {
					echo "failed.<br>";
				}
			}
			else{
				
			}
	
	if($_POST['password'] != $_POST['confirm_password']){
		$errors['password'] = '*Passwords do not match';
		$errors['confirm_password'] = '*Passwords do not match';
	}
}
?>
<html>
	<section class="container grey-text">
		<h4 class="center">Create Account</h4>
		
		<form class="white" action="register.php" method="post">
			<p><b>Enter your information:</b></p>
			<p><label>Email <input type="text" name="email" value="<?php 
						echo htmlspecialchars($email); 
						if (isset($_POST['email'])) { 
							$email = $_POST['email']; 
						}
					?>"><div class="red-text"><?php echo $errors['email']; ?></div></label></p>
					
			<p><label>First Name <input type="text" name="firstName" value="<?php 
						echo htmlspecialchars($firstName); 
						if (isset($_POST['firstName'])) { 
							$firstName = $_POST['firstName']; 
						}
					?>"><div class="red-text"><?php echo $errors['firstName']; ?></div></label></p>
					
			<p><label>Last Name <input type="text" name="lastName" value="<?php 
						echo htmlspecialchars($lastName); 
						if (isset($_POST['lastName'])) { 
							$lastName = $_POST['lastName']; 
						}
					?>"><div class="red-text"><?php echo $errors['lastName']; ?></div></label></p>
					
			<p><label>Password <input type="password" name="password" value="<?php 
						echo htmlspecialchars($password); 
						if (isset($_POST['password'])) { 
							$password = $_POST['password']; 
						}
					?>"><div class="red-text"><?php echo $errors['password']; ?></div>
					
			<p><label>Confirm Password <input type="password" name="confirm_password" value="<?php 
						echo htmlspecialchars($confirm_password); 
						if (isset($_POST['confirm_password'])) { 
							$confirm_password = $_POST['confirm_password']; 
						}
					?>"><div class="red-text"><?php echo $errors['confirm_password']; ?></div></label></p>
					<div class="center">
			<p><input type="submit" value= "Next" name="submit" class="btn brand z-depth-0"></p>
				</div>
			
		</form>
</html>


