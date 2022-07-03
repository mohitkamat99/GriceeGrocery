<?php
include_once 'php/config.php';

$sql = "SELECT * FROM categories";

$query2 = mysqli_query($con, $sql);

session_start();

if (isset($_SESSION['login'])) {
	# code...
	$uid = $_SESSION['UID'];

	$query = "SELECT COUNT(*) AS `count` FROM `shopping_cart` WHERE `User_ID` = '$uid'";

	$sql = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($sql);

	$no_of_items = $row['count'];
} else {
	# code...
	$no_of_items = '0';
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Gricee Grocery - Goa's First Online Grocery Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <meta http-equiv="refresh" content="10"> -->
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
							<span class="text">Delivery as per Availability</span>
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
					<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item dropdown">
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

	<section id="home-section" class="hero">
		<div class="home-slider owl-carousel">
			<div class="slider-item" style="background-image: url(images/bg_1.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

						<div class="col-md-12 ftco-animate text-center">
							<h1 class="mb-2">We serve Fresh Vegestables &amp; Fruits</h1>
							<h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
							<p><a href="#" class="btn btn-primary">View Details</a></p>
						</div>

					</div>
				</div>
			</div>

			<div class="slider-item" style="background-image: url(images/bg_2.jpg);">
				<div class="overlay"></div>
				<div class="container">
					<div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

						<div class="col-sm-12 ftco-animate text-center">
							<h1 class="mb-2">100% Fresh &amp; Organic Foods</h1>
							<h2 class="subheading mb-4">We deliver organic vegetables &amp; fruits</h2>
							<p><a href="shop.php" class="btn btn-primary">View Details</a></p>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row no-gutters ftco-services">
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-1 active d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-shipped"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Free Shipping</h3>
							<span>Every Order</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-2 d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-diet"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Always Fresh</h3>
							<span>Product well package</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-3 d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-award"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Superior Quality</h3>
							<span>Quality Products</span>
						</div>
					</div>
				</div>
				<div class="col-md-3 text-center d-flex align-self-stretch ftco-animate">
					<div class="media block-6 services mb-md-0 mb-4">
						<div class="icon bg-color-4 d-flex justify-content-center align-items-center mb-2">
							<span class="flaticon-customer-service"></span>
						</div>
						<div class="media-body">
							<h3 class="heading">Support</h3>
							<span>24/7 Support</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="ftco-section ftco-category ftco-no-pt">

		<div class="container">
			<div class="slider-text justify-content-center align-items-center" data-scrollax-parent="true">
				<div class="col-sm-12 ftco-animate text-center">
					<h1 class="mb-2" style="font-family: 'Amatic SC', cursive;font-size:7em;">Our Products</h1>
				</div>
			</div>
			<div class="row" style="margin-left: 10%;">
				<?php
				while ($data = mysqli_fetch_array($query2)) {
					# code...
					echo "<div class=\"category-wrap ftco-animate img mb-4 ml-3 d-flex align-items-end\" style=\"background-image: url(data:image;base64," . $data['Category_Image_Temp'] . "); max-width:100%;\">";
					echo "<div class=\"text px-3 py-1\">";
					echo "<h2 class=\"mb-0\"><a href=\"shop.php?name=" . $data['Category_Name'] . "\">" . $data['Category_Name'] . "</a></h2>";
					echo "</div>";
					echo "</div>";
				}
				?>
			</div>

	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<span class="subheading">Find Best Price For Yourself</span>
					<h2 class="mb-4">Deal of The Day</h2>
					<p></p>
				</div>
			</div>
		</div>
		<div class="container" style="margin-left:40%;">
			<div class="row">
				<?php
				$query_deal = mysqli_query($con, "SELECT products.Product_ID,products.Product_Name,products.Product_Description,products.Product_Price,products.Product_Dis_Price,products.Product_Image_Temp,products.Product_Image,inventory.Stock_Items FROM products INNER JOIN inventory ON products.Product_ID = inventory.Product_ID WHERE inventory.Stock_Items >50 AND products.Product_Dis_Price > 10 ORDER BY RAND() LIMIT 1");

				while ($row_deal = mysqli_fetch_assoc($query_deal)) {
					// code...

					echo "<div class=\"col-md-6 col-lg-3 ftco-animate\">";
					echo "<div class=\"product\">";
					echo "<a href=\"product-single.php?id=" . $row_deal['Product_ID'] . "\" class=\"img-prod\"><img class=\"img-fluid\" src=\"data:image;base64," . $row_deal['Product_Image_Temp'] . "\" alt=\"" . $row_deal['Product_Image'] . "\">";
					echo "<span class=\"status\" style=\"font-family: Arial,sans-serif;\">₹" . $row_deal['Product_Dis_Price'] . " OFF</span>";
					echo "<div class=\"overlay\"></div>";
					echo "</a>";
					echo "<div class=\"text py-3 pb-4 px-3 text-center\">";
					echo "<h3><a href=\"product-single.php?id=" . $row_deal['Product_ID'] . "\">" . $row_deal['Product_Name'] . "</a></h3>";
					echo "<div class=\"d-flex\">";
					echo "<div class=\"pricing\">";
					echo "<p class=\"price\" style=\"font-family: Arial,sans-serif;\"><span>₹" . $row_deal['Product_Price'] . "</span></p>";
					echo "</div>";
					echo "</div>";
					echo "<div class=\"bottom-area d-flex px-3\">";
					echo "<div class=\"m-auto d-flex\">";
					echo "<a href=\"product-single.php?id=" . $row_deal['Product_ID'] . "\" class=\"add-to-cart d-flex justify-content-center align-items-center text-center\">";
					echo "<span><i class=\"ion-ios-menu\"></i></span>";
					echo "</a>";
					echo "<a href=\"product-single.php?id=" . $row_deal['Product_ID'] . "\" class=\"buy-now d-flex justify-content-center align-items-center mx-1\">";
					echo "<span><i class=\"ion-ios-cart\"></i></span>";
					echo "</a>";
					echo "<a href=\"product-single.php?id=" . $row_deal['Product_ID'] . "\" class=\"heart d-flex justify-content-center align-items-center\">";
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
		</div>
		<div id="timer" class="d-flex mt-5" style="margin-left:20%;">
			<div class="time" id="days"></div>
			<div class="time pl-3" id="hours"></div>
			<div class="time pl-3" id="minutes"></div>
			<div class="time pl-3" id="seconds"></div>
		</div>
	</section>

	<section class="ftco-section testimony-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Our Developers</span>
					<h2 class="mb-4">Our Team</h2>
					<p></p>
				</div>
			</div>
			<div class="row ftco-animate">
				<div class="col-md-12">
					<div class="carousel-testimony owl-carousel">
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/Arfaat.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">Arfaat lives in Ponda, Goa.</p>
									<p class="name">Arfaat Sayyad</p>
									<span class="position">Back End Developer</span>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/Adi.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">Adishree lives in Ponda, Goa.</p>
									<p class="name">Adishree Shriwant</p>
									<span class="position">Assistant</span>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/Vaish.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">Vaishnavi lives in Mardol, Goa.</p>
									<p class="name">Vaishnavi Palkar</p>
									<span class="position">Technical Writer</span>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/Shrav.jpeg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">Shravani lives in Mardol</p>
									<p class="name">Shravani Malkarnekar</p>
									<span class="position">Technical Writing Assistant</span>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="testimony-wrap p-4 pb-5">
								<div class="user-img mb-5" style="background-image: url(images/Mohit.jpg)">
									<span class="quote d-flex align-items-center justify-content-center">
										<i class="icon-quote-left"></i>
									</span>
								</div>
								<div class="text text-center">
									<p class="mb-5 pl-4 line">Mohit lives in Curchorem, Goa.</p>
									<p class="name">Mohit Kamat</p>
									<span class="position">Web Developer and System Analyst</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<hr>


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

</body>

</html>
