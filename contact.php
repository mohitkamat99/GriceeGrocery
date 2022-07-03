<?php
include_once 'php/config.php';
require 'admin/Admin-GG-estb2019/vendor/autoload.php';
require_once 'admin/Admin-GG-estb2019/pages/tables/credentials.php';
session_start();



if (isset($_SESSION['login'])) {
  $uid = $_SESSION['UID'];
  $query = "SELECT COUNT(*) AS `count` FROM `shopping_cart` WHERE `User_ID` = '$uid'";

  $sql = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($sql);

  $no_of_items = $row['count'];

  $user_query = mysqli_query($con,"SELECT * FROM `user_info` WHERE `User_ID` = '$uid'");
  $user_data = mysqli_fetch_assoc($user_query);
} else {
  # code...
  $no_of_items = '0';
  //header('location:contact.pohp');
}

if (isset($_POST['CU_submit'])) {
  // code...
      $name = $_POST['CName'];
      $Uemail = $_POST['CEmail'];
      $sub = $_POST['Sub'];
      $msg = $_POST['Msg'];

//echo $email;
  $email = new SendGrid\Mail\Mail();
  $email->setFrom($Uemail, "Customer");
  $email->setSubject("Feedback");
  $email->addTo("mohitkamat99@gmail.com", 'Administrator');
  $email->addContent(
      "text/html", '<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <div class="full">
        <div class="row" style="background-color:#86c5da;padding-left:15%;">
          <h1 style="color:white;font-family:Adobe Gothic Std;">Contact Us</h1>
        </div>

          <div class="col" style="padding-left:10%;background-color:#82ae46;">

              <img src="https://i.ibb.co/3vpXJzq/Gricee-Groceryfinal.png" alt="GriceeGroceryfinal" border="0">

          </div>

        <hr>
        <div class="col">
              Name: '.$name.' <br>
              Subject: '.$sub.' <br>
              Message: '.$msg.'
        </div>
      </div>'
  );
  $sendgrid = new \SendGrid($apiKey);

  try {
      $response = $sendgrid->send($email);
      //print $response->statusCode() . "\n";
      //print_r($response->headers());
      //print $response->body() . "\n";
  } catch (Exception $e) {
      echo 'Caught exception: '.  $e->getMessage(). "\n";
      //var_dump(openssl_get_cert_locations());
  }
  if ($response) {
    // code...
    ?>
    <script type="text/javascript">
      alert('Your Feedback Sent');
    </script>

    <?php
  } else {
    // code...
    ?>
    <script type="text/javascript">
      alert('Your Feedback Not Sent');
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
              <span class="text">+ 9637350999</span>
            </div>
            <div class="col-md pr-4 d-flex topper align-items-center">
              <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
              <span class="text">griceegrocery@gmail.com</span>
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
      <a class="navbar-brand" href="index.php"><a class="navbar-brand" href="index.php"><img src="images/GriceeGroceryfinal.png" alt="Gricee Grocery Logo" width="300" height="150"></a></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
            <div class="dropdown-menu" aria-labelledby="dropdown04">
              <a class="dropdown-item" href="shop.php">Shop</a>
              <a class="dropdown-item" href="wishlist.php">Wishlist</a>
              <a class="dropdown-item" href="myorders.php">My Orders</a>
            </div>
          </li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item active"><a href="contact.php" class="nav-link">Contact</a></li>
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
          <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact us</span></p>
          <h1 class="mb-0 bread">Contact us</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section contact-section bg-light">
    <div class="container">
      <div class="row d-flex mb-5 contact-info">
        <div class="w-100"></div>
        <div class="col-md-3 d-flex">
          <div class="info bg-white p-4">
            <p><span>Address:</span> Kakoda, Curchorem Goa</p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="info bg-white p-4">
            <p><span>Phone:</span> <a href="tel://9637350999">+91 9637350999</a></p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="info bg-white p-4">
            <p><span>Email:</span> <a href="mailto:griceegrocery@gmail.com">griceegrocery@gmail.com</a></p>
          </div>
        </div>
        <div class="col-md-3 d-flex">
          <div class="info bg-white p-4">
            <p><span>Website</span> <a href="#">griceegrocery.com</a></p>
          </div>
        </div>
      </div>
      <div class="row block-9">
        <div class="col-md-6 order-md-last d-flex">
          <form method="post" class="bg-white p-5 contact-form" id="contact" name="contact">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your Name" name="CName" id="CName" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" placeholder="Your Email" name="CEmail" id="CEmail" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Subject" name="Sub" id="Sub" required>
            </div>
            <div class="form-group">
              <textarea name="Msg" cols="30" rows="7" class="form-control" placeholder="Message" id="Msg" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5" name="CU_submit">
            </div>
          </form>

        </div>

        <div class="col-md-6 d-flex">
          <div id="map" class="bg-white"></div>
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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg5dxKnKz59b-CWMhYdffgiaWBQs0UsOA&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.js" integrity="sha256-NdDw7k+fJewgwI1XmH9NMR6OILvTX+3arqb/OgFicoM=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.js" integrity="sha256-xLhce0FUawd11QSwrvXSwST0oHhOolNoH9cUXAcsIAg=" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function() {
      $("#contact").validate();
    });
  </script>
</body>

</html>
