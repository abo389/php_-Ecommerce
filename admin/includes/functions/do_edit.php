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

  $select_img = "SELECT image FROM `$table_name` WHERE id='$id'";
  $old_img_name = $conn->query($select_img)->fetch_column();

  // handel image
  $image = handel_img($_FILES,"edit",$old_img_name);
  $files = explode(", ", $image);

  // handel errors
  handel_errors($_POST);
  
  // check for errors
  if(!empty($_SESSION["errors"])) {
    header("location: ".$_SESSION["last_url"]);
    exit();
  }

  if($table_name === "products") {
    $_POST["image"] = $image;
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

  if(isset($_FILES["images"])){//if user select new imgs
    // upload new image
    $tmps = $_FILES["images"]["tmp_name"];
    for ($i=0; $i < count($tmps); $i++) { 
      move_uploaded_file($tmps[$i], "../../images/".$files[$i]);
    }
    // delete old img
    if(count(explode(", ", $old_img_name)) > 1) {
      $imgs = explode(", ", $old_img_name);
      foreach($imgs as $img) {
        unlink("../../images/$img");
      }
    } else {unlink("../../images/$img_name");}
  } 


  header("location: ../../tables.php?name=$table_name");
}
?>