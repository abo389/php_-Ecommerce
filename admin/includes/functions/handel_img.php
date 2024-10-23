<?php 
  
  function handel_img($arr,$action,$old_img_name=[]) {
    if($_FILES["images"]["error"][0] == 0) {


      $names = $arr["images"]["name"];
      $sizes = $arr["images"]["size"];
      $types = [];
      foreach($arr["images"]["type"] as $t) {
        array_push($types, explode("/",$t)[0]);
      }
  
  
      foreach($types as $type) {
        if($type !== "image") {
          $_SESSION["errors"]["image"] = "the file type is not image ";
        }
      }
  
      foreach($sizes as $size) {
        if($size > 3_000_000) {
          $_SESSION["errors"]["image"] = "file most be less than 3MB";
        }
      }
  
      $files = [];
      foreach($names as $name) {
        $n = explode(".",$name);
        $ext = ".".end($n);
        array_push($files, time().rand(0,1000).$ext);
      }
  
      return $files;
    } else {
      if($action === "add") return "";
      elseif ($action === "edit") {
        return $old_img_name;
      }
    }
  }

?>