<?php

function errors($arr) {
    $errors = [];
    var_dump(strpos("hdhtfjtfk"," "));
    // array_map(fn($e)=> trim($e),$arr);
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
    foreach($arr as $k => $v) {
      if(empty($v)) $errors[$k] = $k."is empty";
      elseif($k == "fname" || $k == "lname") {
        echo $v."<br>";
        if(strpos($v," ")) $errors[$k] = "you cant add space here";
      }
      elseif($k == "password-1") {
        $v == $arr["password-2"]?"":$errors["password-2"] = "dosent match prev password";
      }
    }
    echo "<pre>";
    print_r($errors);
    echo "</pre>";
    exit();
}


?>