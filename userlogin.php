<?php

include_once 'php/config.php';

  //session has not started
  session_start();
if(isset($_GET['source'])){
  $source = $_GET['source'];
}

if (isset($_POST['Login'])) {
  $email = $_POST['Email'];
  $password = $_POST['Password'];

  $EncPass = md5($password);

  $query = mysqli_query($con, "SELECT * FROM user_info where `Email` = '$email' AND `Password` = '$EncPass'");
  $row = mysqli_num_rows($query);

  if ($row > 0) {
    // code...
    $data = mysqli_fetch_assoc($query);
    $uid = $data['User_ID'];
    $name = $data['First_Name'];
    $Uemail = $data['Email'];
    $_SESSION['UName'] = $name;
    $_SESSION['UID'] = $uid;
    $_SESSION['EMAIL'] = $Uemail;
    $_SESSION['login'] = "1";
    if (isset($source)) {
      # code...
      header("location:$source");
    } else {
      # code...
      header("location:index.php");
    }


  } else {
    // code...
    // code...
    $_SESSION['login'] = "";
  ?>
    <script type="text/javascript">
      alert("Wrong Credentails");
    </script>

<?php
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Gricee Grocery - Goa's First Online Grocery Website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <style>
    .error {
      color: red;
      font-size: 17px;
    }
  </style>
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
  <link rel="stylesheet" href="css/login.css">
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
      <a class="navbar-brand" href="index.php">Gricee Grocery - Goa's First Online Grocery Website</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu">Menu</span>
      </button>

    </div>
  </nav>
  <!-- END nav -->



  <!-- <section class="ftco-section">
			<div class="container">



			</div>
		</section>

		<section class="ftco-section ftco-category ftco-no-pt">
			<div class="container">

			</div>
		</section>

    <section class="ftco-section">
    	<div class="container">

    	</div>
    	<div class="container">

    	</div>
    </section> -->
  <form action="" name="login-form" id="loginform" method="post">
    <section class="ftco-section-admin img" style="background:#82ae46;">
      <div class="container-admin">
        <div class="row justify-content-end">
          <img src="images/GriceeGrosery.png" alt="griceegrocerylogo" id="logo" style="opacity:1 ">
          <div class="col-md-6-admin heading-section ftco-animate deal-of-the-day ftco-animate">
            <h2 class="mb-4" id="admin">User Login</h2>
            <div class="wrap-inputemail" id="wrap-input">
              <input class="inputemail" type="email" name="Email" id="Email" placeholder="Email" required>
              <input class="inputemail" type="password" name="Password" id="Password" placeholder="Password" minlength="8" title="Enter the password" required>
              <button type="submit" id="login" name="Login" class="login100-form-btn"><b>LOGIN</b></button>
              <a href="forgotpassword.php" style="color: white;">Forgot Password?</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js"></script>

  <script>
    $("#loginform").validate();
  </script>

</body>

</html>
