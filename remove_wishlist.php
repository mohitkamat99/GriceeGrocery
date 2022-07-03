<?php
include_once 'php/config.php';

session_start();

if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];
    $uid = $_SESSION['UID'];
}

$sql = "DELETE FROM `wishlist` WHERE `Product_ID` = '$pro_id' AND `User_ID` = '$uid'";

$del = mysqli_query($con,$sql);

if ($del) {
    # code...
    header('location:wishlist.php');
}
else{
    ?>
        <script>
            alert("Wishlist Item Not Deleted");
        </script>
    <?php
}


?>
