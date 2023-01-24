<head>
	<title>Online Coronavirus Combat Supply Store</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
	.brand{
		background: #FF8C00 !important;
	}
	.brand-text{
		color: #8FBC8F !important;
	}
	form{
		max-width: 460px;
		margin: 20px auto;
		padding: 20px;
	}
	<?php 
		session_start();
		$email = $_SESSION['email'];
		$lastName = $_SESSION['lastName'];
		$firstName = $_SESSION['firstName'];
		$Two_Factor =$_SESSION['Two-Factor'];
		$user_sec_code = $_SESSION['user_sec_code'];
	?>
	</style>
</head>

	<body class="grey lighten-2">
		<nav class="white z-depth-0">
			<?php
			if($email != '' || $email != null){
				echo "<div class=container style=margin-left:160px>";
			}
			else{
				echo"<div class=container style=margin-left:360px>";
			}
			?>
				<a href="index.php" class="brand-logo brand-text" style = "font-size:27px">Online Coronavirus Combat Supply Store</a>
					
					
					<ul id="nav-mobile" class="right hide-on-small-and-down">
					</li>
					
					<li><a href="aboutus.php" button type="button" class="btn btn-outline-primary">
					<?php echo"About Us";?></a><li></button>
					
					<li><a href="dashboard.php" button type="button" class="btn btn-outline-primary">
					<?php echo"Dashboard";?></a><li></button>
					
					<?php if($firstName != ""){	
					echo "<li class='grey-text'>Hello, ";
					echo htmlspecialchars($firstName);?>
					<li><a href="logout.php" class="btn brand z-depth-0" name = "logout">
					<?php 
					echo "LOGOUT";}?></a><li>
					</li>
					<?php if($firstName == ""){	?>
						<li><a href="login.php" class="btn brand z-depth-0" name = "login">
					<?php echo "LOGIN";}?></a><li>
					<!--<a button type="button" class="fa fa-shopping-cart" style="font-size:40px;color:teal"></a><li></button>-->
					
					</ul>
				</div>
			</nav>
		</body>
	</head>