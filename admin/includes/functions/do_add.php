<?php
session_start();
include("connect.php");
include("handel_img.php");
include("handel_errors.php");
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $table_name = $_POST["table_name"];
  array_shift($_POST);
  $_SESSION["errors"] = [];

  // handel image
  $image = handel_img($_FILES,"add");

  // handel errors
  handel_errors($_POST);
  
  // check for errors
  if(!empty($_SESSION["errors"])) {
    header("location: ".$_SESSION["last_url"]);
    exit();
  }

  //  var for insert string
  $colums = implode( ",",array_keys($_POST));
  $values = implode( "' , '",array_values($_POST));

  // send data
  $sql = "INSERT INTO `$table_name` ($colums) VALUES ('$values')";
  $conn->query($sql);
  $pro_id = $conn->insert_id;



  foreach($image as $img){
    $insert = "INSERT INTO images (name,pro_id) VALUES ('$img','$pro_id')";
    $conn->query($insert);
  };
  
  // upload images
  if(isset($_FILES["images"])){
    $tmps = $_FILES["images"]["tmp_name"];
    for ($i=0; $i < count($tmps); $i++) { 
      move_uploaded_file($tmps[$i], "../../images/".$image[$i]);
    }
  };

  // redirect
  header("location: ../../tables.php?name=$table_name");
} else {header("location: ../../tables.php?name=$table_name");}

?>