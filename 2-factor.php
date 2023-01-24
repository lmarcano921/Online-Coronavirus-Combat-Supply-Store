<?php
    
    include('C:\xampp\htdocs\templates\csc350project\db_connect.php');
	include('C:\xampp\htdocs\templates\csc350project\header.php');
    
    require_once 'GoogleAuthenticator.php';
    $secret = $user_sec_code;
    echo $secret;

    $ga = new GoogleAuthenticator();
    
    
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
            <center><h1>Enter Two-Factor code using <br>Google Authenticator</h1></center>
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
								$code = $_POST['pass-code'];
                                
								if ($ga->verifyCode($secret, $code))
								{
									header("location: index.php");     
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