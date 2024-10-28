<?php

function errors($arr) {
    $errors = [];
    array_map(fn($e)=> trim($e),$arr);
    foreach($arr as $k => $v) {
      if(empty($v)) $errors[$k] = $k." is empty";
      elseif($k == "fname" || $k == "lname") {
        if(strpos($v," ")) $errors[$k] = "you cant add space here";
      }
      elseif($k == "password-1") {
        $v == $arr["password-2"]?"":$errors["password-2"] = "dosent match prev password";
      }
    }
    return $errors;
}


?>