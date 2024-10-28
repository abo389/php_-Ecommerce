<?php
  session_start();
  include("includes/functions/conn.php");
  include("includes/functions/errors.php");
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST["permission"] = 4;
    $errors = errors($_POST);
    if(empty($errors)) {
      $full_name = $_POST["fname"]." ".$_POST["lname"];
      $email = $_POST["email"];
      $password = $_POST["password-1"];
      $gender = $_POST["gender"];
      $permission = $_POST["permission"];
      $insert = "INSERT INTO users(name,email,password,gender,permission)
      VALUES('$full_name','$email','$password','$gender','$permission')";
      $conn->query($insert);
      $_SESSION["user_data"]["name"] = $full_name;
      header("location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input  type="text" class="form-control form-control-user" name="fname"
                                            placeholder="First Name">
                                        <?= isset($errors["fname"])?"<div class='alert alert-danger'>$errors[fname]</div>":"" ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input  type="text" class="form-control form-control-user" name="lname"
                                            placeholder="Last Name">
                                            <?= isset($errors["lname"])?"<div class='alert alert-danger'>$errors[lname]</div>":"" ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input  type="email" class="form-control form-control-user" name="email"
                                        placeholder="Email Address">
                                        <?= isset($errors["email"])?"<div class='alert alert-danger'>$errors[email]</div>":"" ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input  type="password" class="form-control form-control-user" name="password-1"
                                            id="exampleInputPassword" placeholder="Password">
                                            <?= isset($errors["password-2"])?"<div class='alert alert-danger'>".$errors['password-2']."</div>":"" ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input  type="password" class="form-control form-control-user" name="password-2"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                            <?= isset($errors["password-2"])?"<div class='alert alert-danger'>".$errors['password-2']."</div>":"" ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                  Gender:  
                                  <div class="form-check d-inline">
                                    <input class="form-check-input" value="3" type="radio" name="gender">
                                    <label class="form-check-label">Male</label>
                                  </div>
                                  <div class="form-check d-inline">
                                    <input class="form-check-input" value="4" type="radio" name="gender">
                                    <label class="form-check-label" >Female</label>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>