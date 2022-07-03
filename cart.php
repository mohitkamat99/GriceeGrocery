<?php
include_once 'php/config.php';

session_start();

if (isset($_SESSION['login'])) {
	# code...
	$uid = $_SESSION['UID'];

	$add = mysqli_query($con, "SELECT * FROM `user_info` WHERE `User_ID` = '$uid'");

	$add_row = mysqli_fetch_assoc($add);

	$query = "SELECT COUNT(*) AS `count` FROM `shopping_cart` WHERE `User_ID` = '$uid'";

	$sql = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($sql);

	$no_of_items = $row['count'];

	$sql = "SELECT * FROM `shopping_cart` WHERE `User_ID` = '$uid'";

	$query_2 = mysqli_query($con, $sql);
	$sub_total = "SELECT SUM(Product_Dis_Price) as `dis_total`,SUM(Total_Price) as `total`, SUM(Quantity) as `quantity` FROM `shopping_cart` WHERE `User_ID` = '$uid' ";
} else {
	$no_of_items = '0';
	header('location:userlogin.php?source=cart.php');
}

$query_sub = mysqli_query($con, $sub_total);

$row_sub = mysqli_fetch_assoc($query_sub);

if (isset($_POST['update_add'])) {
	// code...
	$Landmark = $_POST['Landmark'];
	$House_No_Name = $_POST['House_No_Name'];
	$Place = $_POST['Place'];
	$Taluka = $_POST['Taluka'];
	$District = $_POST['District'];
	$State = "Goa";
	$Pin_Code = $_POST['Pin'];

	$update_add_query = mysqli_query($con, "UPDATE `user_info` SET `Landmark`='$Landmark',`House_No_Name`='$House_No_Name',`Place`='$Place',`Taluka`='$Taluka',`District`='$District',`State`='$State',`Pin_Code`='$Pin_Code'WHERE `User_ID` = $uid");

	if ($update_add_query) {
		// code...
?>
		<script>
			alert('Address Updated');
		</script>
<?php
	header('location:cart.php');
	} else {
		// code...
		echo mysqli_error($con);
	}
}

if (isset($_POST['cod'])) {
	// code...
	$sql9 = "SELECT `Product_ID`,`Product_Name`,`Product_Image`,`Quantity`,`Total_Price` FROM `shopping_cart` WHERE `User_ID` = '$uid'";
	$query_9 = mysqli_query($con, $sql9);

	$inv_q = mysqli_query($con, "SELECT `Product_ID`, `Quantity` FROM `shopping_cart` WHERE `User_ID` = '$uid'");

	$cart_data = array();

	// code...
	while ($data = mysqli_fetch_assoc($query_9)) {
		// code...
		//$quantity_count['Quantity'] = $data['Quantity'];
		$cart_data[] = $data;


		//print_r($cart_data);
		//print_r($quantity_count);
	}

	while ($in_row = mysqli_fetch_assoc($inv_q)) {
		// code...
		$quan_data[] = $in_row;
		//print_r($quan_data);
	}

	if (is_array($cart_data)) {
		# code...
		$values = array();


		foreach ($cart_data as $key => $value) {
			//print_r($value['Product_ID']);
			# code...
			$User_ID = "$uid";
			$Product_ID = mysqli_real_escape_string($con, $value['Product_ID']);
			$Product_Name = mysqli_real_escape_string($con, $value['Product_Name']);
			$Product_Image = mysqli_real_escape_string($con, $value['Product_Image']);
			$Quantity = mysqli_real_escape_string($con, $value['Quantity']);
			$Product_Price = mysqli_real_escape_string($con, $value['Total_Price']);
			$Order_Status = "Processing";
			$Payment_Type = "Cash On Delivery";
			$Payment_Status = "Not Paid";

			$values[] = "('$User_ID','$Product_ID','$Product_Name','$Product_Image','$Quantity','$Product_Price','$Order_Status','$Payment_Type','$Payment_Status')";
		}

		$sql_ins = "INSERT INTO `total_orders`(`User_ID`, `Product_ID`, `Product_Name`,`Product_Image`,`Quantity`, `Total_Price`, `Order_Status`, `Payment_Type`, `Payment_Status`) VALUES ";
		$sql_ins .= implode(', ', $values);
		$insert_order = mysqli_query($con, $sql_ins);
		if ($insert_order) {
			// code...
			if (is_array($quan_data)) {
				// code...
				$datas = array();
				foreach ($quan_data as $key2 => $value2) {
					// code...
					$ProQ = mysqli_real_escape_string($con, $value2['Quantity']);

					$ProID = mysqli_real_escape_string($con, $value2['Product_ID']);



					$up_in = "UPDATE `inventory` SET `Stock_Items`= ABS(Stock_Items - $ProQ) WHERE `Product_ID` = $ProID";
					$up_fin = mysqli_query($con, $up_in);
					$sql_delete = "DELETE FROM `shopping_cart` WHERE `User_ID` = '$uid'";
					$delete_cart = mysqli_query($con, $sql_delete);
					header('location:myorders.php');

					//echo $up_in;

				}
			}
			//
		} else {
			echo mysqli_error($con);
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
							<span class="text">+91 9637350999</span>
						</div>
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							<span class="text">griceegrocery@email.com</span>
						</div>
						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
							<span class="text">Delivery As Per Availability</span>
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
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
					<h1 class="mb-0 bread">My Cart</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section ftco-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-12 ftco-animate">
					<div class="cart-list">
						<table class="table">
							<thead class="thead-primary">
								<tr class="text-center">
									<th>Remove From Cart</th>
									<th>&nbsp;</th>
									<th>Product name</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>

							<tbody>
								<?php
								if ($num_rows = mysqli_num_rows($query_2) == 0) {
									# code...
								?>
									<h3>Your Cart Is Empty</h3>
									<?php
								} else {
									// code...
									while ($row = mysqli_fetch_assoc($query_2)) {
										// code...
									?>
										<tr class="text-center">
											<td class="product-remove"><a href="remove_cart.php?id=<?php echo $row['Product_ID']; ?>"><span class="ion-ios-close"></span></a></td>

											<td class="image-prod"><a href="product-single.php?id=<?php echo $row['Product_ID']; ?>">
													<div class="img" style="background-image:url(<?php echo "data:image;base64," . $row['Product_Image'] . " "; ?>)"></div>
												</a>
											</td>

											<td class="product-name">
												<a href="product-single.php?id=<?php echo $row['Product_ID']; ?>">
													<h3><?php echo $row['Product_Name']; ?></h3>
												</a>
											</td>

											<td class="price"><?php echo $row['Product_Price']; ?></td>

											<td class="quantity">
												<div class="input-group mb-3">
													<input type="text" name="quantity" class="quantity form-control input-number" value='<?php echo $row['Quantity']; ?>' min="1" max="100" disabled>
												</div>
											</td>

											<td class="total"><?php echo $row['Total_Price']; ?></td>
										</tr><!-- END TR-->

								<?php
									}
								}

								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row justify-content-end">

				<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
					<div class="cart-total mb-3">
						<h2>Change Address</h2>
						<form id="update_form" class="info" method="post">
							<div class="form-group">
								<input type="text" class="form-control text-left px-3" name="Landmark" id="Landmark" value="<?php echo $add_row['Landmark']; ?>" placeholder="Landmark" onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32" required>
								<br>
								<input type="text" class="form-control text-left px-3" name="House_No_Name" id="House_No_Name" value="<?php echo $add_row['House_No_Name']; ?>" placeholder=" House No/ House Name" required>
								<br>
								<input type="text" class="form-control text-left px-3" name="Taluka" id="Taluka" value="<?php echo $add_row['Taluka']; ?>" placeholder="Taluka" onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32" required>
								<br>
								<div class="select-wrap">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
									<select id="District" name="District" class="form-control text-left px-3" required>
										<option value="<?php echo $add_row['District']; ?>"><?php echo $add_row['District']; ?></option>
										<option value="">--Select District--</option>
										<option value="North Goa">North Goa</option>
										<option value="South Goa">South Goa</option>
									</select>
								</div>
								<br>
								<input type="text" class="form-control text-left px-3" name="Place" id="Place" value="<?php echo $add_row['Place']; ?>" placeholder="Place/ City" onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32" required>
								<br>
								<input type="text" class="form-control text-left px-3" name="State" id="State" value="<?php echo $add_row['State']; ?>" placeholder="State" disabled>
								<br>
								<input type="text" class="form-control text-left px-3" minlength="6" maxlength="6" name="Pin" id="Pin" value="<?php echo $add_row['Pin_Code']; ?>" placeholder="Pin Code" onkeypress="return isNumber(event);" required>
								<br>
								<input type="submit" id="submit" class="btn btn-primary py-3 px-4" value="Change Address" name="update_add">
							</div>

					</div>
				</div>

				<?php
				if ($num_rows = mysqli_num_rows($query_2) == 0) {
					# code...
				?>

				<?php
				} else {
					// code...
				?>
					<div class="col-lg-4 mt-5 cart-wrap ftco-animate">
						<div class="cart-total mb-3">
							<h3>Cart Totals</h3>
							<p class="d-flex">
								<span>Subtotal(<?php echo $no_of_items; ?> Items)</span>
								<span>₹ <?php echo $row_sub['total']; ?></span>
							</p>
							<p class="d-flex">
								<span>Delivery</span>
								<span>Free</span>
							</p>
							<p class="d-flex total-price">
								<span>Total</span>
								<span>₹ <?php echo $row_sub['total']; ?></span>
							</p>
							<hr>
							<p class="d-flex total-price">
								<span>You Saved ₹ <?php echo $row_sub['dis_total'] ;?></span>
							</p>
						</div>
						<p><a href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
						<p><input type="submit" class="btn btn-primary py-3 px-4" value="Cash On Delivery" name="cod"></p>
					</div>
				<?php
				}


				?>


			</div>
		</div>
		</form>
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
	<script src="js/textbox.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>



	<script>
		$(document).ready(function() {

			var quantitiy = 0;
			$('.quantity-right-plus').click(function(e) {

				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				$('#quantity').val(quantity + 1);


				// Increment

			});

			$('.quantity-left-minus').click(function(e) {
				// Stop acting like a button
				e.preventDefault();
				// Get the field name
				var quantity = parseInt($('#quantity').val());

				// If is not undefined

				// Increment
				if (quantity > 0) {
					$('#quantity').val(quantity - 1);
				}
			});

		});
	</script>

	<script>
		$("#update_form").validate();
	</script>

</body>


</html>
