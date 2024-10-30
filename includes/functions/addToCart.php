<?php
include("conn.php");
if($_SERVER["REQUEST_METHOD"] === "GET") {
  $productId = $_GET["p_id"];
  $userId = $_GET["u_id"];
  $insert = "INSERT INTO cart(pro_id,user_id,quantity)VALUES('$productId','$userId','1')";
  $conn->query($insert);
  header("location: ../../cart.php");
}
?>