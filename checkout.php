<?php
session_start();
require_once("db.php");
$name_array= array();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shopping Cart</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/styling.css">
	<!-- Scripts -->
	<script type="text/javascript" src="assets/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="assets/bootstrap.min.js"></script>
</head>
	
<body>
	<section class="parallaxCheckout">
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header text-center brand">
						<a href="index.php" class="navbar-brand" id="brandName">THE JORDAN STORE</a>
					</div>
				</div>
			</nav>
		</header>
		<div class="container-fluid center" id="shoppingCartTable" align="center">
			<form method="post" action="checkout_authorize.php">
				<?php
				if(!empty($_SESSION["items"]))
				{
				?>
				
				<input type="hidden" name="items_collection" value="<?php echo implode(" ",$GLOBALS['name_array']); ?>">
				<label id="total_price">Total</label>
				<input class="form-control" id="amount" type="number" name="total_price" value="<?php echo $_POST['total_price']; ?>"><br>
				<input class="form-control" type="text" name="firstName" value="" placeholder="First Name" required><br>
				<input class="form-control" type="text" name="lastName" value="" placeholder="Last Name" required><br>
				<input class="form-control" type="text" name="address" value="" placeholder="Address" required><br>
				<input class="form-control" type="number" name="zipCode" value="" placeholder="Zip Code" required><br>
				<input class="form-control" type="email" name="email" value="" placeholder="Email" required><br>
				<input class="form-control" type="number" name="phoneNumber" value="" placeholder="Phone Number" required><br>
				<input class="form-control" type="number" name="creditCardNumber" value="" placeholder="Credit Card Number" required><br>

				<?php
				}
				?>
				<input class="btn btn-lg btn-default" id="checkout_auth" type="submit" name="checkout_auth" value="Checkout">
			</form>
		</div>
	</section>




</body>
</html>