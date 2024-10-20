<?php
  session_start();
//   include("../functions/connect.php");
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $check = "SELECT * FROM users WHERE 
    email='$email' AND
    password='$password'";
    $user_data = $conn->query($check)->fetch_assoc();
    $is_user = $conn->query($check)->num_rows === 1;
    if($is_user) {
        $_SESSION["user"] = implode(",",$user_data);
        header("location: index.php");
    }
    else {
      $m = "<div class='alert alert-danger'>Wrong email or password</div>";
    }
  }

  ?>