<?php
include_once 'php/config.php';

session_start();

if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];
    $uid = $_SESSION['UID'];
}

$sql = "DELETE FROM `shopping_cart` WHERE `Product_ID` = '$pro_id' AND `User_ID` = '$uid'";

$del = mysqli_query($con,$sql);

if ($del) {
    # code...
    header('location:cart.php');
}
else{
    ?>
        <script>
            alert("Cart Item Not Deleted");
        </script>
    <?php
}


?>
