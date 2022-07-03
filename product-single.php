<?php
include_once 'php/config.php';
session_start();
if (isset($_SESSION['login'])) {
	# code...
	$uid = $_SESSION['UID'];



	$query = "SELECT COUNT(*) AS `count` FROM `shopping_cart` WHERE `User_ID` = '$uid'";

	$sql = mysqli_query($con, $query);
	$row4 = mysqli_fetch_assoc($sql);

	$no_of_items = $row4['count'];
} else {
	$no_of_items = '0';
	$uid = NULL;
}


if (isset($_GET['id'])) {
	$prod_id = $_GET['id'];

	$query_5 = mysqli_query($con, "SELECT * FROM `shopping_cart`  WHERE `User_ID` = '$uid' AND `Product_ID` = '$prod_id'");
	$row1 = mysqli_num_rows($query_5);

	$query_stock = mysqli_query($con, "SELECT * FROM `inventory`  WHERE `Product_ID` = '$prod_id' AND `Stock_Items` <= '0'");
	$stock_row = mysqli_num_rows($query_stock);

	$query_stock_limited = mysqli_query($con, "SELECT * FROM `inventory`  WHERE `Product_ID` = '$prod_id' AND `Stock_Items` <= '5'");
	$quantity_store_query = mysqli_fetch_assoc($query_stock_limited);
	$quantity_store = $quantity_store_query['Stock_Items'];
	$stock_row_limited = mysqli_num_rows($query_stock_limited);

	$query_1 = "SELECT * FROM `products` WHERE `Product_ID` = '$prod_id'";

	$sql = mysqli_query($con, $query_1);

	$wish = mysqli_query($con, "SELECT * FROM `wishlist` WHERE `User_ID` = '$uid' AND `Product_ID` = '$prod_id'");
	$wish_row = mysqli_num_rows($wish);

	while ($row2 = mysqli_fetch_array($sql)) {
		# code...
		$pro_id = $row2['Product_ID'];
		$pro_name = $row2['Product_Name'];
		$pro_des = $row2['Product_Description'];
		$pro_img = $row2['Product_Image'];
		$pro_img_temp = $row2['Product_Image_Temp'];
		$pro_cat = $row2['Category_ID'];
		$pro_price = $row2['Product_Price'];
		$pro_dis_price = $row2['Product_Dis_Price'];
	}
	if (isset($_POST['Add_cart'])) {
		# code...
		if ((isset($_SESSION['login']))) {
			# code...
			$quant = $_POST['quantity'];
			$total_price = $pro_price * $quant;
			$dis = $pro_dis_price * $quant;
			$sql2 = "INSERT INTO `shopping_cart`(`Product_ID`, `User_ID`, `Product_Name`, `Quantity`, `Product_Price`, `Total_Price`,`Product_Image`,`Product_Dis_Price`) VALUES ('$pro_id','$uid','$pro_name','$quant','$pro_price','$total_price','$pro_img_temp','$dis')";

			$sql_s = "SELECT `Product_ID`, `User_ID`, `Product_Name` FROM `shopping_cart`  WHERE `User_ID` = '$uid'";
			$query_4 = mysqli_query($con, $sql_s);
			$row = mysqli_num_rows($query_4);
			$sql4 = mysqli_query($con, $sql2);
			if ($sql4) {
				//echo var_dump($sql4);
				echo mysqli_error($con);
				header('location:cart.php');
			} else {
				echo mysqli_error($con);
?>
				<script>
					alert('Not Added To The Cart');
				</script>
			<?php
			}
		} else {
			header('location:userlogin.php?source=cart.php');
		}
	}

	if (isset($_POST['Add_wish'])) {
		// code...
		if ((isset($_SESSION['login']))) {

			if ($wish_row > 1) {
				// code...
			?>
				<script type="text/javascript">
					alert('Item Already Present');
				</script>
				<?php
			} else {
				// code...
				$wish_ins = mysqli_query($con, "INSERT INTO `wishlist`(`Product_ID`, `User_ID`, `Product_Name`, `Product_Image`, `Product_Price`) VALUES ('$pro_id','$uid','$pro_name','$pro_img_temp','$pro_price')");
				if ($wish_ins) {
					// code...
					header('location:wishlist.php');
				} else {
					// code...
				?>
					<script type="text/javascript">
						alert('Not Inserted');
					</script>
<?php
				}
			}
		} else {
			// code...
			header('location:userlogin.php?source=wishlist.php');
		}
	}
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gricee Grocery - Goa's First Online Grocery Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">


	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="goto-here">
	<div class="py-1 bg-primary">
		<div class="container">
			<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
				<div class="col-lg-12 d-block">
					<div class="row d-flex">
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
							<span class="text">9637350999</span>
						</div>
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							<span class="text">griceegrocery@email.com</span>
						</div>
						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
							<span class="text">Delivery as Per Availability</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php"><img src="images/GriceeGroceryfinal.png" alt="Gricee Grocery Logo" width="300" height="150"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item active dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
						<div class="dropdown-menu" aria-labelledby="dropdown04">
							<a class="dropdown-item" href="shop.php">Shop</a>
							<a class="dropdown-item" href="wishlist.php">Wishlist</a>
							<a class="dropdown-item" href="myorders.php">My Orders</a>
						</div>
					</li>
					<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
					<?php
					if (!(isset($_SESSION['login']))) {
						echo "<li class=\"nav-item\"><a href=\"userlogin.php?source=index.php\" class=\"nav-link\">Log In</a></li>";
						echo "<li class=\"nav-item\"><a href=\"user-registration.php\" class=\"nav-link\">Register</a></li>";
					} else {
						echo "<li class=\"nav-item\"><a href=\"\" class=\"nav-link\">Welcome " . $_SESSION['UName'] . "</a></li>";
						echo "<li class=\"nav-item\"><a href=\"logout.php\" class=\"nav-link\">Log Out</a></li>";
					}

					?>
					<li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?php echo $no_of_items; ?>]</a></li>

				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="index.php">Product</a></span> <span>Product Single</span></p>
					<h1 class="mb-0 bread">Product Details</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<form action="" name="single-product" method="POST">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 mb-5 ftco-animate">
						<?php
						echo "<a href=\"data:image;base64," . $pro_img_temp . "\" class=\"image-popup\">";
						echo "<img src=\"data:image;base64," . $pro_img_temp . "\" class=\"img-fluid\" alt=\"$pro_name.jpg\" style=\"height:250px; width:250px;\">";
						echo "</a>";
						?>
					</div>
					<div class="col-lg-6 product-details pl-md-5 ftco-animate">
						<h3><?php echo "$pro_name"; ?></h3>
						<p class="price" style="margin-bottom:-10px;">MRP: <s style="font-family: Arial,sans-serif;">₹<?php $total = $pro_price + $pro_dis_price;
																		echo "$total"; ?></s></p>
						<p class="price" style="margin-bottom:-5px;">Price: <span style="font-size:25px; font-family: Arial,sans-serif; color:#B12704 !important;">₹<?php echo "$pro_price"; ?></span></p>
						<p class="price">Savings: <span style="font-size:15px; font-family: Arial,sans-serif; color:#B12704 !important;">₹<?php $per = $pro_dis_price / $total * 100;
																					$r = round($per);
																					echo "$pro_dis_price ($r%)"; ?></span></p>
						<p>Description:</p>
						<p><?php echo "$pro_des"; ?>
						</p>


						<?php

						if ($row1 == 1) {
							# code...
						?>
							<p><b>Your Item Already In The Cart</b></p>

						<?php

						} elseif ($stock_row) {
							// code...
						?>
							<p style="color:red;"><b>Out of Stock</b></p>
						<?php
						} elseif ($stock_row_limited) {

						?>
							<div class="row mt-4">
								<div class="w-100"></div>
								<div class="input-group col-md-6 d-flex mb-3">
									<!-- <span class="input-group-btn mr-2">
										<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
											<i class="ion-ios-remove"></i>
										</button>
									</span> -->
									<input type="text" id="" name="quantity" class="form-control input-number" value="1" min="1" max="" readonly>
									<!-- <span class="input-group-btn ml-2">
										<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
											<i class="ion-ios-add"></i>
										</button>
									</span> -->

								</div>
								<p> in Kgs / Qty</p>
								<div class="w-100"></div>
								<div class="col-md-12">
									<p style="color: #000;"></p>
								</div>
							</div>
							<p style="color:red;"><b>Only <?php echo $quantity_store; ?> Items Left Hurry Up!!!!</b></p>
							<p><input type="submit" name="Add_cart" value="Add To Cart" class="btn btn-black py-3 px-5"></p>
						<?php

						} else {

						?>
							<div class="row mt-4">
								<div class="w-100"></div>
								<div class="input-group col-md-6 d-flex mb-3">
									<span class="input-group-btn mr-2">
										<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
											<i class="ion-ios-remove"></i>
										</button>
									</span>
									<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="5" readonly>
									<span class="input-group-btn ml-2">
										<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
											<i class="ion-ios-add"></i>
										</button>
									</span>

								</div>
								<p> in Kgs / Qty</p>
								<div class="w-100"></div>
								<div class="col-md-12">
									<p style="color: #000;"></p>
								</div>
							</div>
							<p><input type="submit" name="Add_cart" value="Add To Cart" class="btn btn-black py-3 px-5"></p>
						<?php
						}
						if ($wish_row == 1) {
							// code...
						?>
							<p>Your Item Already In The Wishlist</p>
						<?php
						} else {
							// code...
						?>
							<p><input type="submit" name="Add_wish" value="Add To Wishlist" class="btn btn-black py-3 px-5"></p>
						<?php
						}

						?>


					</div>
				</div>
			</div>
		</form>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Products</span>
					<h2 class="mb-4">Related Products</h2>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<?php
				$sql = "SELECT * FROM `products` WHERE `Category_ID` = '$pro_cat' ORDER BY RAND() LIMIT 4";

				$query_2 = mysqli_query($con, $sql);

				while ($row = mysqli_fetch_assoc($query_2)) {
					echo "<div class=\"col-md-6 col-lg-3 ftco-animate\">";
					echo "<div class=\"product\">";
					echo "<a href=\"product-single.php?id=" . $row['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row['Product_Image_Temp'] . "\" alt=\"" . $row['Product_Image'] . "\">";
					echo "<span class=\"status\">₹" . $row['Product_Dis_Price'] . " OFF</span>";
					echo "<div class=\"overlay\"></div>";
					echo "</a>";
					echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
					echo "<h3><a href=\"\">" . $row['Product_Name'] . "</a></h3>";
					echo "<div class=\"d-flex\">";
					echo "<div class=\"pricing\">";
					echo "<p class=\"price\"><span>₹" . $row['Product_Price'] . "</span></p>";
					echo "</div>";
					echo "</div>";
					echo "<div class=\"bottom-area d-flex px-3\">";
					echo "<div class=\"m-auto d-flex\">";
					echo "<a href=\"product-single.php?id=" . $row['Product_ID'] . "\" class=\"add-to-cart d-flex justify-content-center align-items-center text-center\">";
					echo "<span><i class=\"ion-ios-menu\"></i></span>";
					echo "</a>";
					echo "<a href=\"#\" class=\"buy-now d-flex justify-content-center align-items-center mx-1\">";
					echo "<span><i class=\"ion-ios-cart\"></i></span>";
					echo "</a>";
					echo "<a href=\"\" class=\"heart d-flex justify-content-center align-items-center\">";
					echo "<span><i class=\"ion-ios-heart\"></i></span>";
					echo "</a>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
				}
				?>
			</div>
	</section>


	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Gricee Grocery - Goa's First Online Grocery Website</h2>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Menu</h2>
						<ul class="list-unstyled">
							<li><a href="shop.php" class="py-2 d-block">Shop</a></li>
							<li><a href="about.php" class="py-2 d-block">About</a></li>
							<li><a href="contact.php" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+91 9637350999</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span class="text">griceegrocery@gmail.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
		</div>
	</footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>

<!-- 	<script>
		$(document).ready(function() {
			$.ajax({
				type: 'GET',
				url: '../../library/library.xml',
				dataType: 'xml',
				success: function(xml) {
					setInterval('refreshPage()', 5000);
				}
			});
		});

		function refreshPage() {
			location.reload(true);
		}
	</script>
 -->
	<script>
		$(document).ready(function() {

			var quantity = 1;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity < 5) {
					$('#quantity').val(quantity + 1);
				}

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 1) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

</body>

</html>
