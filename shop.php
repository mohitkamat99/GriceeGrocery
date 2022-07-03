<?php
include_once 'php/config.php';
//session_start();
if (isset($_GET['pageno'])) {
	$pageno = $_GET['pageno'];
} else {
	$pageno = 1;
}

$no_of_records_per_page = 8;
$offset = ($pageno - 1) * $no_of_records_per_page;


$total_pages_sql = "SELECT COUNT(*) FROM products";
$result = mysqli_query($con, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

if (isset($_SESSION['login'])) {
	# code...
	$uid = $_SESSION['UID'];



	$cart_query = "SELECT COUNT(*) AS `count` FROM `shopping_cart` WHERE `User_ID` = '$uid'";

	$sql = mysqli_query($con, $cart_query);
	$row4 = mysqli_fetch_assoc($sql);

	$no_of_items = $row4['count'];
} else {
	$no_of_items = '0';
	$uid = NULL;
}

$sql = "SELECT * FROM categories";

$sql2 = "SELECT products.Product_ID,products.Product_Name,products.Product_Description,products.Product_Price,products.Product_Dis_Price,products.Product_Image_Temp,products.Product_Image,categories.Category_Name FROM products INNER JOIN categories ON products.Category_ID = categories.Category_ID ORDER BY RAND()";

$query_stock = mysqli_query($con, "SELECT * FROM `inventory`  WHERE `Stock_Items` <= '0'");
$stock_row = mysqli_num_rows($query_stock);

$query = mysqli_query($con, $sql);
$query2 = mysqli_query($con, $sql2);

// $page = $_SERVER['HTTP_HOST'];

// $page .= $_SERVER['PHP_SELF'];


//$page = "name=";
$page = '';
if (isset($_GET['name'])) {
	$page = $_GET['name'];
	//echo $page;

	$no_of_records_per_page = 8;
	$offset = ($pageno - 1) * $no_of_records_per_page;


	$total_pages_sql = "SELECT COUNT(*) FROM products INNER JOIN categories ON products.Category_ID = categories.Category_ID WHERE categories.Category_Name = '$page'";
	$result = mysqli_query($con, $total_pages_sql);
	$total_rows = mysqli_fetch_array($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);

	$sql3 = "SELECT products.Product_ID,products.Product_Name,products.Product_Description,products.Product_Price,products.Product_Dis_Price,products.Product_Image_Temp,products.Product_Image,categories.Category_Name FROM products INNER JOIN categories ON products.Category_ID = categories.Category_ID WHERE categories.Category_Name = '$page' ORDER BY RAND() LIMIT $offset, $no_of_records_per_page";

	$sql = "SELECT products.Product_ID,products.Product_Name,products.Product_Description,products.Product_Price,products.Product_Dis_Price,products.Product_Image_Temp,products.Product_Image,categories.Category_Name FROM products INNER JOIN categories ON products.Category_ID = categories.Category_ID WHERE categories.Category_Name = '$page' ORDER BY RAND()";
	$query3 = mysqli_query($con, $sql);
}







//$res_data = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gricee Grocery - Goa's First Online Grocery Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <meta http-equiv="refresh" content="3"> -->

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
	<style>
		.hide {
			display: none;
		}
	</style>
	<form action="" class="" method="get">
		<div id="pageload">
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
									<span class="text">griceegrocery@gmail.com</span>
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
							<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Products</span></p>
							<h1 class="mb-0 bread">Products</h1>
						</div>
					</div>
				</div>
			</div>

			<section class="ftco-section">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-10 mb-5 text-center">
							<ul class="product-category" id="product-category">
								<li><a href="shop.php" class="<?php if (!isset($_GET['name'])) : //echo "active";
												?>

								<?php endif; ?>">All</a></li>

								<?php
								$cat_query = mysqli_query($con, "SELECT * FROM `categories` ORDER BY `Category_ID` DESC ");

								while ($cat_fetch = mysqli_fetch_assoc($cat_query)) {
									# code...
								?>
									<li><a href="shop.php?name=<?php echo $cat_fetch['Category_Name']; ?>" class="<?php if ($page == 'Vegetables') : //echo "active";
																			?>

									<?php endif; ?>"><?php echo $cat_fetch['Category_Name']; ?></a></li>

								<?php
								}

								?>


								<!-- <li><a href="shop.php?name=Vegetables" class="<?php if ($page == 'Vegetables') : echo "active"; ?>

								<?php endif; ?>">Vegetables</a></li>

								<li><a href="shop.php?name=Beverages" class="<?php if ($page == 'Beverages') : echo "active"; ?>

								<?php endif; ?>">Beverages</a></li>

								<li><a href="shop.php?name=Fruits" class="<?php if ($page == 'Fruits') : echo "active"; ?>

								<?php endif; ?>">Fruits</a></li>

								<li><a href="shop.php?name=Grains" class="<?php if ($page == 'Grains') : echo "active"; ?>

								<?php endif; ?>">Grains</a></li> -->

							</ul>
						</div>
					</div>
					<input class="form-control" placeholder="Search Product. E.g. Carrot" style="margin-bottom:10px;">
					<div class="row" id="content">
						<?php

						if (isset($_GET['name'])) {
							$page = $_GET['name'];
							//echo $page;
							if ($page == '') {
								echo "<h3 id=\"item\"> Invalid Request </h3>";
								//header("refresh: 1; url = shop.php");
								// while ($row2 = mysqli_fetch_array($query2)) {
								// 	$query_stock = mysqli_query($con, "SELECT * FROM `inventory`  WHERE `Stock_Items` <= '0' AND `Product_ID` = '".$row2['Product_ID']."'");
								// 	$stock_row = mysqli_num_rows($query_stock);
								// 	if ($stock_row) {
								// 		// code...
								// 		echo "<div class=\"col-md-6 col-lg-3 ftco-animate\">";
								// 		echo "<div class=\"product\">";
								// 		echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row2['Product_Image_Temp'] . "\" alt=\"" . $row2['Product_Image'] . "\">";
								// 		echo "<span class=\"status\">₹" . $row2['Product_Dis_Price'] . " OFF</span>";
								// 		echo "<div class=\"overlay\"></div>";
								// 		echo "</a>";
								// 		echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
								// 		echo "<h3><a href=\"product-single.php?id=" . $row2['Product_ID'] . "\">" . $row2['Product_Name'] . "</a></h3>";
								// 		echo "<div class=\"d-flex\">";
								// 		echo "<div class=\"pricing\">";
								// 		echo "<p class=\"price\"><span>₹" . $row2['Product_Price'] . "</span></p>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "<div class=\"bottom-area d-flex px-3\">";
								// 		echo "<div class=\"m-auto d-flex\">";
								// 		echo "	<p style=\"color:red;\"><b>Out of Stock</b></p>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 	} else {
								// 		// code...
								// 		echo "<div class=\"col-md-6 col-lg-3 ftco-animate\">";
								// 		echo "<div class=\"product\">";
								// 		echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row2['Product_Image_Temp'] . "\" alt=\"" . $row2['Product_Image'] . "\">";
								// 		echo "<span class=\"status\">₹" . $row2['Product_Dis_Price'] . " OFF</span>";
								// 		echo "<div class=\"overlay\"></div>";
								// 		echo "</a>";
								// 		echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
								// 		echo "<h3><a href=\"product-single.php?id=" . $row2['Product_ID'] . "\">" . $row2['Product_Name'] . "</a></h3>";
								// 		echo "<div class=\"d-flex\">";
								// 		echo "<div class=\"pricing\">";
								// 		echo "<p class=\"price\"><span>₹" . $row2['Product_Price'] . "</span></p>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "<div class=\"bottom-area d-flex px-3\">";
								// 		echo "<div class=\"m-auto d-flex\">";
								// 		echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"add-to-cart d-flex justify-content-center align-items-center text-center\">";
								// 		echo "<span><i class=\"ion-ios-menu\"></i></span>";
								// 		echo "</a>";
								// 		echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"buy-now d-flex justify-content-center align-items-center mx-1\">";
								// 		echo "<span><i class=\"ion-ios-cart\"></i></span>";
								// 		echo "</a>";
								// 		echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"heart d-flex justify-content-center align-items-center\">";
								// 		echo "<span><i class=\"ion-ios-heart\"></i></span>";
								// 		echo "</a>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 	}
								//
								// 	# code...
								//
								// }
							} elseif ($row3 = mysqli_num_rows($query3) == 0) {
								echo "<h3 id=\"item\"> No Results </h3>";
							} else {
								while ($row3 = mysqli_fetch_array($query3)) {
									# code...
									$query_stock = mysqli_query($con, "SELECT * FROM `inventory`  WHERE `Stock_Items` <= '0' AND `Product_ID` = '" . $row3['Product_ID'] . "'");
									$stock_row = mysqli_num_rows($query_stock);
									if ($stock_row) {
										// code...
										echo "<div class=\"col-md-6 col-lg-3\" id=\"item\">";
										echo "<div class=\"product\">";
										echo "<a href=\"product-single.php?id=" . $row3['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row3['Product_Image_Temp'] . "\" alt=\"" . $row3['Product_Image'] . "\">";
										echo "<span class=\"status\" style=\"font-family: Arial,sans-serif;\">₹" . $row3['Product_Dis_Price'] . " OFF</span>";
										echo "<div class=\"overlay\"></div>";
										echo "</a>";
										echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
										echo "<h3><a href=\"product-single.php?id=" . $row3['Product_ID'] . "\">" . $row3['Product_Name'] . "</a></h3>";
										echo "<div class=\"d-flex\">";
										echo "<div class=\"pricing\">";
										echo "<p class=\"price\"><span style=\"font-family: Arial,sans-serif;\">₹" . $row3['Product_Price'] . "</span></p>";
										echo "</div>";
										echo "</div>";
										echo "<div class=\"bottom-area d-flex px-3\">";
										echo "<div class=\"m-auto d-flex\">";
										echo "	<p style=\"color:red;\"><b>Out of Stock</b></p>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
									} else {
										// code...
										echo "<div class=\"col-md-6 col-lg-3\" id=\"item\">";
										echo "<div class=\"product\">";
										echo "<a href=\"product-single.php?id=" . $row3['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row3['Product_Image_Temp'] . "\" alt=\"" . $row3['Product_Image'] . "\">";
										echo "<span class=\"status\" style=\"font-family: Arial,sans-serif;\">₹" . $row3['Product_Dis_Price'] . " OFF</span>";
										echo "<div class=\"overlay\"></div>";
										echo "</a>";
										echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
										echo "<h3><a href=\"product-single.php?id=" . $row3['Product_ID'] . "\">" . $row3['Product_Name'] . "</a></h3>";
										echo "<div class=\"d-flex\">";
										echo "<div class=\"pricing\">";
										echo "<p class=\"price\"><span style=\"font-family: Arial,sans-serif;\">₹" . $row3['Product_Price'] . "</span></p>";
										echo "</div>";
										echo "</div>";
										echo "<div class=\"bottom-area d-flex px-3\">";
										echo "<div class=\"m-auto d-flex\">";
										echo "<a href=\"product-single.php?id=" . $row3['Product_ID'] . "\" class=\"add-to-cart d-flex justify-content-center align-items-center text-center\">";
										echo "<span><i class=\"ion-ios-menu\"></i></span>";
										echo "</a>";
										echo "<a href=\"product-single.php?id=" . $row3['Product_ID'] . "\" class=\"buy-now d-flex justify-content-center align-items-center mx-1\">";
										echo "<span><i class=\"ion-ios-cart\"></i></span>";
										echo "</a>";
										echo "<a href=\"product-single.php?id=" . $row3['Product_ID'] . "\" class=\"heart d-flex justify-content-center align-items-center\">";
										echo "<span><i class=\"ion-ios-heart\"></i></span>";
										echo "</a>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
										echo "</div>";
									}
								}
							}
						} else {
							while ($row2 = mysqli_fetch_array($query2)) {
								# code...
								$query_stock = mysqli_query($con, "SELECT * FROM `inventory`  WHERE `Stock_Items` <= '0' AND `Product_ID` = '" . $row2['Product_ID'] . "'");
								$stock_row = mysqli_num_rows($query_stock);
								if ($stock_row) {
									// code...
									echo "<div class=\"col-md-6 col-lg-3\" id=\"item\">";
									echo "<div class=\"product\">";
									echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row2['Product_Image_Temp'] . "\" alt=\"" . $row2['Product_Image'] . "\">";
									echo "<span class=\"status\" style=\"font-family: Arial,sans-serif;\">₹" . $row2['Product_Dis_Price'] . " OFF</span>";
									echo "<div class=\"overlay\"></div>";
									echo "</a>";
									echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
									echo "<h3><a href=\"product-single.php?id=" . $row2['Product_ID'] . "\">" . $row2['Product_Name'] . "</a></h3>";
									echo "<div class=\"d-flex\">";
									echo "<div class=\"pricing\">";
									echo "<p class=\"price\"><span style=\"font-family: Arial,sans-serif;\">₹" . $row2['Product_Price'] . "</span></p>";
									echo "</div>";
									echo "</div>";
									echo "<div class=\"bottom-area d-flex px-3\">";
									echo "<div class=\"m-auto d-flex\">";
									echo "	<p style=\"color:red;\"><b>Out of Stock</b></p>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
								} else {
									// code...
									echo "<div class=\"col-md-6 col-lg-3\" id=\"item\">";
									echo "<div class=\"product\">";
									echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row2['Product_Image_Temp'] . "\" alt=\"" . $row2['Product_Image'] . "\">";
									echo "<span class=\"status\" style=\"font-family: Arial,sans-serif;\">₹" . $row2['Product_Dis_Price'] . " OFF</span>";
									echo "<div class=\"overlay\"></div>";
									echo "</a>";
									echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
									echo "<h3><a href=\"product-single.php?id=" . $row2['Product_ID'] . "\">" . $row2['Product_Name'] . "</a></h3>";
									echo "<div class=\"d-flex\">";
									echo "<div class=\"pricing\">";
									echo "<p class=\"price\"><span style=\"font-family: Arial,sans-serif;\">₹" . $row2['Product_Price'] . "</span></p>";
									echo "</div>";
									echo "</div>";
									echo "<div class=\"bottom-area d-flex px-3\">";
									echo "<div class=\"m-auto d-flex\">";
									echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"add-to-cart d-flex justify-content-center align-items-center text-center\">";
									echo "<span><i class=\"ion-ios-menu\"></i></span>";
									echo "</a>";
									echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"buy-now d-flex justify-content-center align-items-center mx-1\">";
									echo "<span><i class=\"ion-ios-cart\"></i></span>";
									echo "</a>";
									echo "<a href=\"product-single.php?id=" . $row2['Product_ID'] . "\" class=\"heart d-flex justify-content-center align-items-center\">";
									echo "<span><i class=\"ion-ios-heart\"></i></span>";
									echo "</a>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
								}
							}
						}

						?>
					</div>


					<div class="row mt-5">
						<div class="col text-center">
							<div class="block-27" id="pagingControls">

							</div>
						</div>
					</div>



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
			<script src="js/active.js"></script>
			<script src="js/flexible.pagination.js"></script>

			<script>
				$(function() {

					var flexiblePagination = $('#content').flexiblePagination({
						itemsPerPage: 8,
						itemSelector: '#item:visible',
						pagingControlsContainer: '#pagingControls',
						showingInfoSelector: '#showingInfo',
						searchBoxSelector: '.form-control',
						displayedPages: 4,
						css: {
							//btnNumberingClass: 'btn btn-sm btn-primary',
							btnNumberingClass: 'btn btn-sm btn-primary',
							btnFirstClass: 'btn btn-sm btn-success',
							btnLastClass: 'btn btn-sm btn-success',
							btnNextClass: 'btn btn-sm btn-success',
							btnPreviousClass: 'btn btn-sm btn-success'
						},
						//search: {
						//onClick: true,
						// onClickSelector: '#search'
						//}
					});
					//flexiblePagination.getController().onPageClick = function(pageNum, e){
					//	 console.log('You Clicked Page: '+pageNum)
					//};

					// Direct JS Object method of using the FlexiblePagination
					//        var pager = new Flexible.Pagination();
					//        pager.itemsPerPage = 1;
					//        pager.pagingContainer = '#content';
					//        pager.itemSelector = 'div.result:visible';  //That is, Select and paginate only the filtered visible '.result' div.
					//        pager.pagingControlsContainer = '#pagingControls';
					//        pager.search.onClick = false;
					//        pager.search.onClickSelector = '';
					//        pager.showCurrentPage();
				});
			</script>

			<input type="hidden" name="product_name" id="name">
		</div>
	</form>


</body>

</html>
