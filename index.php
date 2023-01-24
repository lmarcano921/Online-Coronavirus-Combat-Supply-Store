<?php
	ob_start();
	
	include('C:\xampp\htdocs\templates\csc350project\db_connect.php');			//change directory
	include('C:\xampp\htdocs\templates\csc350project\header.php');
	
	$sql = 'SELECT Item, Qty, Price, Description, ID FROM items ORDER BY ID';

	$result = mysqli_query($con, $sql);




if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["ID"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["ID"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["ID"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["ID"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>

<!DOCTYPE html>
<html>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
<?php 
if($email != '' || $email != null){
	echo "<div class=container style=margin-left:150px>";
}
else{
	echo"<div class=container style=margin-left:350px>";
}
?>
	<br>
	<h4 class="center" style="font-size:50px;color:#003333;font-family:georgia;">Our Warehouse</h4>
	
		<div class="row">
			<?php 
				if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><font size="6" face="timesnewroman"
          color="rgb(128, 128, 0)"> 
		  
				<h4 class="text-info"><b><?php echo $row["Item"]; ?></h4></b>

						<h4 class="text-danger">$<?php echo $row["Price"]; ?></h4>
						<h4 class="text-danger" style="color:#003333"><?php echo $row["Description"]; ?></h4>
						
						<form method="post" action="index.php?action=add&ID=<?php echo $row["ID"]; ?>">
						
						<?php if($email != '' || $email != null){?>
							<input type="number" name="quantity" value="1" min = "1" max = "99" style="text-align:center;" class = "form-control"/>
							<input type="hidden" name="hidden_name" value="<?php echo $row["Item"]; ?>" />
							<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />
							
							<input type="submit" name="add_to_cart" style="margin-top:5px;text-align:center;" class="btn btn-success" value="Add to Cart" />
							
							<h4 class="text-danger" style="color:#003333">
							<?php /*
							if($row["Qty"] != 0){
								echo "Quantity: ".$row["Qty"]; 
							}
							else if($row["Qty"] == 0){
								echo "<p style=color:red>Out of Stock</p>";
							}*/
						}?></h4>
						</form>
							</ul>
						</div>					
					</div>
				</div>
				<?php
					}
				}
			?>
		</div>
	</div>
	<html>
	
<?php 
	
	if(isset($_POST['checkout'])){
		header('Location: checkout.php');
		unset($_SESSION["shopping_cart"]);
		/*foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["ID"])
			{
				
				 //$finalQty =  - $values["item_quantity"];
			}
		}*/
	}
	
	if($email != '' || $email != null){
		?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<nav class="w3-display-topright w3-sidebar w3-blue w3-top w3-large" style="z-index:3;width:500px;font-weight:bold;" id="mySidebar"><br>
	  <div class="w3-container">
		<h3 style="text-align:center;font-size:35px"><b>Shopping Cart <a class="fa fa-shopping-cart" style="font-size:40px;color:white"></a></b></h3>
		<div style="clear:both"></div>
			<br />
			<?php
			if(!empty($_SESSION["shopping_cart"])){?>
			<div class="table-responsive;w3-display-bottom">
				<table class="table table-bordered w3-white" style = "font-size:18px">
					<tr>
						<th width="10%">Item Name</th>
						<th width="10%">Qty</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$<?php echo $values["item_price"]; ?></td>
						<td>$<?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="index.php?action=delete&ID=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$<?php echo number_format($total, 2); 
						$_SESSION['total'] = $total;
						
						?></td>
						<td></td>
					</tr>
					</table>
					<form method = "post" action = "index.php">
						<input type="submit" name="checkout" style="float: right" class="btn" value="checkout">
					</form>
					
					<?php
					}
					else{
						echo "<h4 style=text-align:center>Your shopping cart is empty.";
					}

	}
	?>

			</div>
		</div>
	</div>
	<br />
	</body>
  </div>
</nav>

	
</html>


