<?php
include("../conn.php");
$id = $_GET["id"];

$select_img = "SELECT image FROM products WHERE id='$id'";
$img_name = $conn->query($select_img)->fetch_column();
unlink("../images/$img_name");

$delete = "DELETE FROM `products` WHERE id='$id'";
$conn->query($delete);
header("location: ../products.php");