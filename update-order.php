<?php
include_once 'php/config.php';
//require '../../vendor/autoload.php';
//require 'credentials.php';
session_start();

$oid = $_GET['q'];
$pid = $_GET['r'];
$quant = $_GET['p'];
$sql = "UPDATE `total_orders` SET `Order_Status`='Cancelled',`Payment_Status`='Refunded',`Date_OF_Purchase`= CURRENT_TIMESTAMP WHERE `Order_No` = '$oid'";

$final_query = mysqli_query($con, $sql);

$sql2 = "UPDATE `inventory` SET `Stock_Items`= ABS(Stock_Items + $quant) WHERE `Product_ID` = $pid";
$final_query2 = mysqli_query($con, $sql2);




if ($final_query) {
        # code...
        if ($final_query2) {
                # code...
?>
                <script>
                        alert('Order Cancelled');
                </script>

<?php
          header('location:myorders.php');

        }

}



?>
