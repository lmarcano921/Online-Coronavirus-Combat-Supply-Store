<?php

    //declare(strict_types=1);
    

    include('C:\xampp\htdocs\templates\csc350project\db_connect.php');
	include('C:\xampp\htdocs\templates\csc350project\header.php');
    
    //require_once 'vendor/autoload.php';
    require_once 'GoogleAuthenticator.php';
    
    
    //$ga = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    $ga = new GoogleAuthenticator(); //obj for Google Authenticator Library

    $secret = $_SESSION['secret'];
    $qr = $_SESSION['qr'];
    
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "occss";
	$con = new mysqli($servername, $username, $password, $dbname);
	if ($con->connect_error) {
	  die("Connection failed: " . $con->connect_error);
	}
	
    $email = $_SESSION['email'];
	$lastName = $_SESSION['lastName'];
	$firstName = $_SESSION['firstName'];
	$Two_Factor = $_SESSION['Two_Factor'];
	$ID = $_SESSION['ID'];
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../library/css/bootstrap.min.css"/>
        <script type ="text/javascript" src="../library/js/jquery-3.5.1.min.js"></script>
        <script 
        defer src= "2-FactorScript.js">
        var code =<?php echo json_encode($scode); ?>;
        </script>
    </head>
    <body>
        <div class = "container well; white">  
            <center><h1>Two-Factor Authentication using <br>Google Authenticator</h1></center>
            <div style ="width: 50%; margin:10px auto;">
                <center><img src="<?=$qr;?>"></center><br>
                <p class="text-justify">
                    Please install <strong> Google Aunthenticator</strong> App in your phone, open it and then
                    scan the above bar code to add this application. After you have added this application enter the code you see 
                    in the Google Authenticator App into the below input box to complete the login process.
                </p>
                <form action="" id ="form" method ="post" class="form-horizontal">
                    <div class = "form-group">
                        <div class = "input-group">
                            <div class= "input-group-addon addon-diff-color">
                                <span class= "glyphicon glyphicon-lock"></span>
                            </div>
                            <input type="text" autocomplete="off" class="form-control" name="pass-code" style="text-align:center;" placeholder="Enter Code">
                        </div>
						
                            <center><input type="submit" value="Submit" class="btn btn-warning btn-block" name="submit"></center>
                            <div id = "error"></div>
							<?php
							if(isset($_POST['submit']))
							{
                                $code = $_POST['pass-code']; //takes input Google code from the user
                                $scode = $ga->verifyCode($secret, $code, 3); //verifies if the code from the user matches the code Google sent
								if ($scode) 
								{
                                    $sql = "UPDATE users SET Two_Factor = '1', user_sec_code = '$secret' WHERE ID = $ID";
									if ($con->query($sql) === TRUE) {
										$query = "SELECT Two_Factor FROM users WHERE ID = '$ID'";
										$result = mysqli_query($con, $query);
										if ($result = $con->query($query)) {    
											while ($row = $result->fetch_object()) {
												$Two_Factor =$row->Two_Factor;
											}
											$_SESSION['Two_Factor'] = $Two_Factor;
											$result->close();
										}
										header("location: 2-factor-success.php");    
									  echo "Update Successful";
									} else {
									  echo "Error updating record: " . $con->error;
									}
									 
								}
								else 
								{
									echo "<center><p style=color:red>Invalid code. Re-enter your authenticator code. \n</p></center>";
								}
							}
							?>
                    </div>
                </form>
            </div>
        </div>
    <div style="position:fixed; bottom: 10px; right: 10px; color:green;">
        <strong>OCCSS</strong>
    </div>              
    </body>
</html>