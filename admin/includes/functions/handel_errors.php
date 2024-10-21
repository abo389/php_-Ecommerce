<?php

function handel_errors($data) {
  foreach($data as $k =>  $v) {
    if(empty($v)) $_SESSION["errors"][$k] = "$k is empty";
    elseif($k == "email" && !filter_var($data["email"],FILTER_VALIDATE_EMAIL)) {
      $_SESSION["errors"]["email"] = "email is not valid";
    }
    elseif($k == "password" && strlen($data["password"]) < 8) {
      $_SESSION["errors"]["password"] = "password most be at least 8 char";
    }
  }
}

?>