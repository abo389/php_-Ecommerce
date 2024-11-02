<?php
include("conn.php");
if($_SERVER["REQUEST_METHOD"] === "GET") {
  $productId = $_GET["p_id"];
  $userId = $_GET["u_id"];

  $delete = "DELETE FROM cart WHERE pro_id='$productId' AND user_id='$userId'";
  $conn->query($delete);
  header("location: ../../cart.php");
}