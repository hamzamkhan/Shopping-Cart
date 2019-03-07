<?php
session_start();
require_once("db.php");
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
	<section class="parallaxFive">
		<header>
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-header text-center brand">
						<a href="index.php" class="navbar-brand" id="brandName">THE JORDAN STORE</a>
					</div>
				</div>
			</nav>
		</header>
		<div class="container-fluid">
			<?php if(isset($_SESSION['item_added'])) { ?>
		    <div class="row">
		      <div class="col-mid-12 successMessage">
		        <div class="alert alert-success" style="color:black;">
		          Item Successfully Added!
		        </div>
		      </div>
		    </div>
		    <?php unset($_SESSION['item_added']); } ?>
			<div class="jumbotron text-center">
				<p id="newArrivals">NEW ARRIVALS</p>
				<a href="#shopping"><img id="downArrow" class="animated fadeInDown" src="images/white-down-arrow-png-2.png" alt="down-arrow"></a>
			</div>
		</div>
	</section>
	<section id="shopping" class="parallaxTwo">
		<div class="container-fluid">
			<div class="row" align="center" >
				<?php
				$query = "SELECT * FROM items ORDER BY id ASC";
				$result = mysqli_query($conn,$query);
			    if(mysqli_num_rows($result) > 0)
			    {
			        while($row = mysqli_fetch_array($result))
			        {
			    ?>
					<div class="col-lg-4" id="itemRow">
						<form method="POST" action="add_to_cart.php?action=add&id=<?php echo $row["id"];?>">
							<div id="itemsDisplay" class="card" align="center">
		                        <?php
		                        echo '<img width="150px" height="150px"  src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
		                        ?>
		    
			                        <h4 class="itemInfo text-info"><?php echo $row["name"]; ?></h4>
			                        <h6 class="itemInfo text-info">Rs.<?php echo $row["price"]; ?></h6>
		                        
		                        <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
		 						<input type="submit" style="margin-top: 5px;" class="btn btn-default submitBtn" value="Add to Cart">
	                		</div>
						</form>
					</div>
				<?php
					}
				}

				?>
			</div>

			<form action="shopping_cart.php" >
    			<input type="submit" class="btn btn-lg btn-default cartBtn" value="Proceed To Cart" />
			</form>
			
		</div>
	</section>
	<script type="text/javascript">
     $(function(){
      $(".successMessage:visible").fadeOut(3000); //miliseconds of time
     });
   	</script> 
</body>
</html>