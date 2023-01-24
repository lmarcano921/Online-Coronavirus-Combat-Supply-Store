<?php
	include('C:\xampp\htdocs\templates\csc350project\header.php');
	include('C:\xampp\htdocs\templates\csc350project\db_connect.php');		//change directory

		
	$error = "Don't have an account with us?<br>Sign up now!";
	$email = $password = $firstName = $lastName = $Two_Factor = $ID =$user_sec_code = '';
	$myEmail = $myPassword = '';
	$errors = array('email' => '', 'password' => '');
	$tf = false;
	

	if(isset($_POST['submit'])){
		$myEmail = $_POST['email'];
		$myPassword = $_POST['password'];
			
		$myEmail = stripslashes($myEmail);
		$myPassword = stripslashes($myPassword);
			
		$query = "SELECT ID, email, firstName, lastName, password, Two_Factor, user_sec_code FROM users WHERE email = '$myEmail' and password = '$myPassword'";
		$result = mysqli_query($con, $query);
		$count = mysqli_num_rows($result);
		
		if ($result = $con->query($query)) {    
			while ($row = $result->fetch_object()) {
				$ID = $row->ID;
				$firstName = $row->firstName;
				$lastName =$row->lastName;
				$Two_Factor =$row->Two_Factor;
				$user_sec_code =$row->user_sec_code;
			}
			$_SESSION['ID'] = $ID;
			$_SESSION['firstName'] = $firstName;
			$_SESSION['lastName'] = $lastName;
			$_SESSION['Two_Factor'] = $Two_Factor;
			$_SESSION['user_sec_code'] = $user_sec_code;
			$result->close();
		}
		else
		{
		   echo'something went wrong.';
		}

		if($count > 0 ){	//logged in
			if($Two_Factor == '1'){
			session_start();
			$_SESSION['email'] = $_POST['email'];
			header('Location: 2-factor.php');
			}
			else if($Two_Factor != '1'){
				$_SESSION['email'] = $_POST['email'];
				header('Location: index.php');
			}
		}
		else{
			$tf = true;
		}
		if(empty($_POST['email'])){
			$errors['email'] = '*An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = '*Email must be a valid email address';
			}
		}
		if(empty($_POST['password'])){
			$errors['password'] = '*A password is required';
		} else{
			$password = $_POST['password'];
			if($count < 1){
				$errors['password'] = '* Password is incorrect';
			}
		}
			
	}
	
		
?>

	<html>
	<section class="container grey-text">
		<h4 class="center">Login</h4>
		<form class="white" action="login.php" method="post">
			<label>Email</label>
			<input type="text" name="email" value="<?php 
				if (isset($_POST['email'])) { 
					$email = $_POST['email']; 
				}
			?>"><div class="red-text"><?php echo $errors['email']; ?></div>

			<label>Password</label>
			<input type="password" name="password" value="<?php 
				echo htmlspecialchars($password); 
				if (isset($_POST['password'])) { 
					$password = $_POST['password']; 
				}
			?>"><div class="red-text"><?php echo $errors['password']; ?></div>
			
			
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
				<div class="red-text"><br><?php echo $error;?></div>
				<button><a href="register.php">Register</a></button>
			<div class="center">
			</div>
		</form>
	</section>

</html>