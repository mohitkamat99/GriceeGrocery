<?php

require 'config.php';




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

 ?>
