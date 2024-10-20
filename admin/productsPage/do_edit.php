<?php

include("../conn.php");

$id = $_GET["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$cat = $_POST["cat"];
$brand = $_POST["brand"];
$count = $_POST["count"];
$description = $_POST["description"];

if($_FILES["image"]["error"] === 0) {
  $img_name = $_FILES["image"]["name"];
  $img_size = $_FILES["image"]["size"];
  $img_tmp = $_FILES["image"]["tmp_name"];
  $img_type = explode("/",$_FILES["image"]["type"])[0];


  if($img_type !== "image") {
      echo "the file type is not image ";
      exit();
  }

  if($img_size > 3_000_000) {
      echo "file most be less than 3MB";
      exit();
  }

  $new_img_name = time().rand(0,100).$img_name;
  move_uploaded_file($img_tmp, "./../images/$new_img_name");

  
  // delete old img
  $select_img = "SELECT image FROM products WHERE id='$id'";
  $img_name = $conn->query($select_img)->fetch_column();
  unlink("../images/$img_name");

  $update = "UPDATE products SET name= '$name', price= '$price',image= '$new_img_name',cat= '$cat',brand= '$brand', count= '$count', description= '$description' WHERE products.id='$id'";
  $conn->query($update);

}
else {
  $update = "UPDATE products SET name= '$name', price= '$price',cat= '$cat',brand= '$brand', count= '$count', description= '$description' WHERE products.id='$id'";
  $conn->query($update);
}




header("location: ../products.php");