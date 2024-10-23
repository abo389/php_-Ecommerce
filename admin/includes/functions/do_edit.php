<?php
session_start();
include("connect.php");
include("handel_img.php");
include("handel_errors.php");
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $table_name = $_POST["table_name"];
  $id = $_POST["id"];
  array_shift($_POST);
  array_shift($_POST);
  $_SESSION["errors"] = [];

  // handel image
  if($table_name === "products") {
    $select_img = "SELECT name FROM `images` WHERE pro_id='$id'";
    $old_img_name = $conn->query($select_img)->fetch_all();
    $old_images = [];
    for ($i=0; $i < count($old_img_name); $i++) { 
      array_push($old_images,$old_img_name[$i][0]);
    }
    $image = handel_img($_FILES,"edit",$old_images);
  }  



  // handel errors
  handel_errors($_POST);
  
  // check for errors
  if(!empty($_SESSION["errors"])) {
    header("location: ".$_SESSION["last_url"]);
    exit();
  }


  $mix = [] ;
  $colums = array_keys($_POST);
  $values = array_values($_POST);
  for ($i=0; $i < count($_POST); $i++) { 
    array_push($mix, "`$colums[$i]`='$values[$i]'");
  }
  $mix = implode(", ",$mix);

  // send data
  $sql = "UPDATE `$table_name` SET $mix WHERE id='$id'";
  $conn->query($sql);




  if($table_name === "products" && $_FILES["images"]["error"][0] == 0){//if user select new imgs
    // upload new image 
    $tmps = $_FILES["images"]["tmp_name"];
    for ($i=0; $i < count($tmps); $i++) { 
      move_uploaded_file($tmps[$i], "../../images/".$image[$i]);
      $insert = "INSERT INTO images (name,pro_id) VALUES ('$image[$i]','$id')";
      $conn->query($insert);
    }
      foreach($old_images as $img) {
        unlink("../../images/$img");
        $sql = "DELETE FROM `images` WHERE name='$img'";
        $conn->query($sql);
      }
  } 


  header("location: ../../tables.php?name=$table_name");
}
?>