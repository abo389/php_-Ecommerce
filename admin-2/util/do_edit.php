<?php
include("../../functions/connect.php");
if($_SERVER["REQUEST_METHOD"] === "POST") {
  // handel image
  if(isset($_FILES["image"])) {
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
  }
  $table_name = $_POST["table_name"];
  $id = $_POST["id"];
  array_shift($_POST);
  array_shift($_POST);
  if($table_name === "products") {
    $_POST["image"] = $new_img_name;
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
  if(isset($_FILES["image"])) move_uploaded_file($img_tmp, "../../admin/images/$new_img_name");
  header("location: ../tables.php?name=$table_name");
}
?>