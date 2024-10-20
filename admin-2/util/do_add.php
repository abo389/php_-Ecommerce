<?php
session_start();
include("../../functions/connect.php");
if($_SERVER["REQUEST_METHOD"] === "POST") {
  $table_name = $_POST["table_name"];
  array_shift($_POST);
  $errors =[];


    // handel image
  if(isset($_FILES["images"])) {
    $names = $_FILES["images"]["name"];
    $sizes = $_FILES["images"]["size"];
    $tmps = $_FILES["images"]["tmp_name"];
    $types = [];
    foreach($_FILES["images"]["type"] as $t) {
      array_push($types, explode("/",$t)[0]);
    }


    foreach($types as $type) {
      if($type !== "image") {
          $errors["images"]["type"] = "the file type is not image ";
      }
    }

    foreach($sizes as $size) {
      if($size > 3_000_000) {
        $errors["images"]["size"] = "file most be less than 3MB";
      }
    }

    $files = [];
    foreach($names as $name) {
      array_push($files, time().rand(0,100).$name);
    }

    // echo "<pre>";
    // echo "</pre>";

    $new_img_name = implode(", " ,$files);
  } else {$new_img_name = "";}


  // check for errors
  foreach($_POST as $k =>  $v) {
    if(empty($v)) $errors[$k] = "$k is empty";
    elseif($k == "email" && !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
      $errors["email"] = "email is not valid";
    }
    elseif($k == "password" && strlen($_POST["password"]) < 8) {
      $errors["password"] = "password most be at least 8 char";
    }
  }



  if(!empty($errors)) {
    $_SESSION["errors"] = $errors;
    $url_2 = $_SESSION["last_url"];
    header("location: $url_2");
    exit();
  }




  //  var for insert string
  if($table_name === "products") {
    $_POST["image"] = $new_img_name;
  }
  $colums = implode( ",",array_keys($_POST));
  $values = implode( "' , '",array_values($_POST));




  // send data
  $sql = "INSERT INTO `$table_name` ($colums) VALUES ('$values')";
  $conn->query($sql);

  // upload images
  if(isset($_FILES["images"])){
    for ($i=0; $i < count($tmps); $i++) { 
      move_uploaded_file($tmps[$i], "../../admin/images/".$files[$i]);
      // echo $tmps[$i];
    }
  };

  // exit();

  // redirect
  header("location: ../tables.php?name=$table_name");
}
?>