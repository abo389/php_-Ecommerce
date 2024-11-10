<?php
include("conn.php");
if($_SERVER["REQUEST_METHOD"] === "GET") {
  $productId = $_GET["p_id"];
  $userId = $_GET["u_id"];
  
  // check if item alredy exist
  // $item => 1
  // $item => 0
  $item = $conn->query("SELECT * FROM cart WHERE user_id='$userId' AND pro_id='$productId'")->num_rows;
  if($item) {
    $insert = "UPDATE cart SET quantity = quantity + 1 WHERE pro_id=".$productId." AND user_id=".$userId;
  } else {
    $insert = "INSERT INTO cart(pro_id,user_id,quantity)VALUES('$productId','$userId','1')";
  }

  $conn->query($insert);
  header("location: ../../cart.php");
}
?>