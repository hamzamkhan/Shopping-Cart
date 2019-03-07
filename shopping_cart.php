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
<body class="parallaxSix">
	<section>
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
			<form method="post" action="checkout.php">
				<?php
				if(!empty($_SESSION["items"]))
				{
					$total=0;
					foreach($_SESSION["items"] as $keys => $items)
					{
						array_push($GLOBALS['name_array'], $items["quantity"]);
			            array_push($GLOBALS['name_array'], $items["name"]);

				?>
				<table cellpadding="0" cellspacing="0" class="table table-responsive table-striped">
					<tr>
				        <td width="50%"><?php echo $items["name"]; ?></td>
				        <td width="10%"><?php echo $items["quantity"]; ?></td>
				        <td width="20%">Rs.<?php echo $items["price"]; ?></td>
				        <td width="15%"><?php echo number_format((int)$items["quantity"] * (int)$items["price"], 2); ?></td>
				        <td width="5%"><a href="add_to_cart.php?action=delete&id=<?php echo $items['id_item']; ?>"><span class="text-danger">Remove</span></a></td>
			        </tr>    
			        <?php
			        $total = $total + ((int)$items["quantity"]*(int)$items["price"]);
			    	}
			        ?>
			        <tr id="totalRow">
			        	<td colspan="3" align="right">Total</td>
			            <td align="right">Rs.<?php echo number_format($total,2); ?></td>
			            <input type="hidden" name="total_price" value="<?php echo $total; ?>">
			        </tr>                    
			        <?php
			        } 
			        ?>
			    </table>
			        <?php
			        if(!empty($_SESSION["items"]))
			        {
			        ?>
			        
			        <br>
			        <input type="submit" class="btn btn-success" name="proceed_checkout" value="Proceed To Checkout">
			        <?php
			        }
			        ?>
		    </form>		
		</div>
		<?php
		if(empty($_SESSION["items"]))
		{
		?>
		<div class="container-fluid center text-center" id="shoppingCartTable">
			<p>No Items Added To The Cart</p>
		</div>
		<?php
		}	
		?>
	</section>

</body>
</html>