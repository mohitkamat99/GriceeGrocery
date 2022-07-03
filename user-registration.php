<?php
include_once 'php/config.php';

session_start();

if (isset($_POST['user-submit'])) {
	# code...
	if (isset($_SESSION['OTP'])) {
		$otp = $_SESSION['OTP'];
		$OtpFin = $_POST['otp'];
		if ($otp == $OtpFin) {
			$First_Name = $_POST['First_Name'];
			$Last_Name = $_POST['Last_Name'];
			$Landmark = $_POST['Landmark'];
			$House_No_Name = $_POST['House_No_Name'];
			$Place = $_POST['Place'];
			$Taluka = $_POST['Taluka'];
			$District = $_POST['District'];
			$State = "Goa";
			$Pin_Code = $_POST['Pin'];
			$Mobile_Number = $_POST['Mobile_Number'];
			$Email = $_POST['Email'];
			$Password = $_POST['Password'];

			$EncPass = md5($Password);



			$result_email = mysqli_query($con, "SELECT `Email`,`Password`,`Mobile_Number` FROM `user_info` WHERE `Email` = '$Email'");

			$result_mobile = mysqli_query($con, "SELECT `Email`,`Password`,`Mobile_Number` FROM `user_info` WHERE `Mobile_Number` = '$Mobile_Number'");

			$result_pass = mysqli_query($con, "SELECT `Email`,`Password`,`Mobile_Number` FROM `user_info` WHERE `Password` = '$EncPass'");



			$total_email = mysqli_num_rows($result_email);
			$total_mobile = mysqli_num_rows($result_mobile);
			$total_pass = mysqli_num_rows($result_pass);

			//if ($Password == $EncPass) {
			# code...
			//echo 'Correct';
			//}

			if ($total_email > 0) {
				# code...
?>
				<script>
					alert('Email Already Exists');
					//return false;
				</script>

			<?php

			} elseif ($total_mobile > 0) {
			?>
				<script>
					alert('Mobile Number Already Exists');
					//return false;
				</script>

			<?php

			} elseif ($total_pass > 0) {
			?>
				<script>
					alert('Password Already Exist');
					//return false;
				</script>

				<?php

			} else {
				# code...
				$sql = "INSERT INTO `user_info`(`First_Name`, `Last_Name`, `Landmark`, `House_No_Name`,`Place`,`Taluka`,`District`,`State`,`Pin_Code`,`Mobile_Number`,`Email`,`Password`) VALUES ('$First_Name','$Last_Name','$Landmark','$House_No_Name','$Place','$Taluka','$District','$State','$Pin_Code','$Mobile_Number','$Email','$EncPass')";
				$query = mysqli_query($con, $sql);
				if ($query) {
					session_destroy();
					header('location:userlogin.php');
				} else {
					//echo mysqli_error($con);

				?>
					<script>
						alert('Email or Password or Mobile Number Already Exist');
						//return false;
					</script>

			<?php
				}
			}
		} else {
			session_destroy();
			?>
			<script>
				alert('OTP is Wrong');
				//return false;
			</script>

<?php
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

	<style>
		.error {
			color: red;
		}
	</style>


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
			<a class="navbar-brand" href="index.php">Gricee Grocery</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

		</div>
	</nav>
	<!-- END nav -->

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span>Register</span></p>
					<h1 class="mb-0 bread">User Registration</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xl-7 ftco-animate">
					<form action="" class="user-form" method="POST" id="regform" name="reg">
						<h3 class="mb-4 billing-heading">Customer Details</h3>
						<div class="row align-items-end">
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">First Name</label>
									<input type="text" name="First_Name" id="First_Name" class="form-control" placeholder="" required minlength="2" onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<label for="lastname">Last Name</label>
									<input type="text" name="Last_Name" id="Last_Name" class="form-control" placeholder="" required minlength="3" onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
								</div>
							</div>
							<div class=" w-100"></div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="country">State</label>
									<div class="select-wrap">
										<div class="icon"><span class="ion-ios-arrow-down"></span></div>
										<select id="State" name="State" class="form-control" disabled>
											<option value="Goa">Goa</option>
										</select>
									</div>
								</div>
							</div>
							<div class="w-100"></div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="streetaddress">Street Address</label>
									<input type="text" class="form-control" id="Landmark" name="Landmark" placeholder="Landmark" required onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="House_No_Name" name="House_No_Name" placeholder="House  Number/Name or Bldg Name/Floor Number" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="firstname">Taluka</label>
									<input type="text" name="Taluka" id="Taluka" class="form-control" placeholder="" required onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="country">District</label>
									<div class="select-wrap">
										<div class="icon"><span class="ion-ios-arrow-down"></span></div>
										<select id="District" name="District" class="form-control" required>
											<option value="">Select The District</option>
											<option value="North Goa">North Goa</option>
											<option value="South Goa">South Goa</option>
										</select>
									</div>
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="towncity">Town / City</label>
									<input type="text" id="Place" name="Place" class="form-control" placeholder="" required onkeypress="return (event.charCode > 64 &&
									event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || event.charCode == 32">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="postcodezip">Postcode / ZIP *</label>
									<input type="text" id="Pin" name="Pin" class="form-control" placeholder="" required maxlength="6" minlength="6" onkeypress="return isNumber(event);">
								</div>
							</div>
							<div class="w-100"></div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Phone</label>
									<input type="text" id="phone" class="form-control" name="Mobile_Number" placeholder="" required maxlength="10" minlength="10" onkeypress="return isNumber(event);">
									<label for="success" class="error" id="mobile_success" style="display:none;">Mobile Number Already Taken</label>
								</div>
							</div>
							<div class=" col-md-6">
								<div class="form-group">
									<label for="emailaddress">Email Address</label>
									<input type="email" id="Email" name="Email" class="form-control" required>
									<label for="success" class="error" id="email_success" style="display:none;">Email Already Taken</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="phone">Password</label>
									<input type="password" id="Password" name="Password" class="form-control" placeholder="" required pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" minlength="8">
									<label for="success" class="error" id="pass_success" style="display:none;">Password Already Taken</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="emailaddress">Confirm Password</label>
									<input type="password" id="Con_Pass" name="Con_Pass" class="form-control" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="Please Match The Password" minlength="8" placeholder="" required>
								</div>
							</div>
							<div class="col-md-6" style="margin-left: 12em !important; display:none;" id="txtDiv">
								<div class="form-group">
									<input id="textInput" type="text" class="form-control" placeholder="OTP" id="otp-input" name="otp" minlength="4" maxlength="4" onkeypress="return isNumber(event);" required>
								</div>
							</div>
							<div class="w-100"></div>
							<br>
							<br>
							<div class="col-md-12" style="margin-left: 16em !important;">
								<div class="form-group">
									<p><button type="button" name="otp-submit" id="mybutton" class="btn btn-primary py-3 px-4">Get OTP</button></p>
									<label for="success" class="error" id="otp_success" style="display:none;">OTP Sent</label>
									<p><input type="submit" name="user-submit" id="mysubmit" class="btn btn-primary py-3 px-4" value="Submit" style="display:none;"></p>
									<label for="error" class="error" id="suberr" style="display:none;">Fill the details</label>
								</div>
							</div>
					</form><!-- END -->
				</div>

	</section> <!-- .section -->

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
						<p></p>
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
						</script> All rights reserved |<i class="icon-heart color-danger" aria-hidden="true"></i> by Gricee Grocery</a>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="js/textbox.js"></script>
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
		//obj = document.getElementById('phone');
		$(document).ready(function() {
			$("#regform").validate({
				rules: {
					Con_Pass: {
						equalTo: "#Password"
					}


				},
				messages: {
					Password: "Recomended Password(UpperCase, LowerCase, Number / SpecialChar and min 8 Chars)"

				}
			});

			$("#mybutton").click(function() {
				if (!$("#regform").valid()) {
					//$("#verifyModal").modal('show');
					//alert("Mobile number can not be blank and has to be 10 digits!");
					return false;
				} else {
					$("#txtDiv").show();
					$("#mysubmit").show();
					$("#mybutton").hide();

					$.ajax({
						type: "POST",
						url: "otp_process.php",
						data: {
							type: 1,
							email: $('#Email').val(),
							password: $('#Password').val(),
							phone: $('#phone').val(),
							otpinput: $('#otp-input').val()
						},
						success: function(dataResult) {
							var dataResult = JSON.parse(dataResult);
							if (dataResult.statusCode == 200) {
								$('#otp_success').show();
							}
						}
					});
				}
			});


		});
	</script>

</body>

</html>