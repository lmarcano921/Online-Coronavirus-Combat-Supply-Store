
<?php 
include('C:\xampp\htdocs\templates\csc350project\db_connect.php');				//change directory
include('C:\xampp\htdocs\templates\csc350project\header.php'); 					//change directory

?>

<html>

	<section class="container grey-text">
	<h4 class="center">2-Step Verification</h4>
	<script defer src= "2-StepScript.js"></script> <!--javascript script for 2step verification page-->
    
<?php
    $code = "";
    function generateKey() //generates the key to be sent to user
    {
        $keyLength = 8;
        $characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomStr = substr(str_shuffle($characters), 0, $keyLength);
        return $randomStr;
    }
    
    function sendEmail() //send email to user
    {
        $to_email = $_SESSION['email'];
        $subject = "2-Step Verification";
        $message = "Hi " . $_SESSION['firstName'] . ".\n\nThis is your 2-step verification number: ";
        $header = "From: OCCSS";
        $sCode = generateKey();
        $body = $message . $sCode;

        if (mail($to_email, $subject, $body, $header)) 
        {
            echo "Email successfully sent to $to_email...";
        } 
        else 
        {
            echo "Email sending failed...";
        }
        return $sCode;
    }


?>

<h4 class="center"> 
    <?php 
        
        $code = sendEmail(); //this is where the email gets sent
        
    ?>
    <!--<input type="text" id="code" name="code" value="<?php //echo htmlspecialchars($code);?>" /> -->
    <!--hopefully this gets the php variable into javascript... IT DOES... but it's not useful because it displays the variable...-->
    <script>
    var code=<?php echo json_encode($code); ?>; //converts php variable into a javascript variable
    </script>
</h4>
<section class="container grey-text">
		<h4 class="center">
        <form id ="form" name ="form" action ="success.php" class="white">
            <p><b>Enter the code you received via email:</b></p>
            <p><label> <center><input type="text" id="codecheck" name="codecheck" value = ""></center>
            <div class="center">
			<p><input type="submit" value= "submit" name="submit" class="btn brand z-depth-0"></p>
            <h5>
            <div id = "error"></div>
            </h5>
            </h4>
            <div class="center">
            <section class = "container black-text">
            Didn't receive an email? Click here to resend.
        </form>
        <form id ="form" action="2-Step-Verification.php" method="post">
        <input type="submit" id="resend" value="resend" name="resend" class="btn brand z-depth-0"></form>
</html>