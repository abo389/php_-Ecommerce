<?php
  include("includes/functions/conn.php");
  include("includes/functions/errors.php");
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $_POST["permission"] = 4;
    $errors = errors($_POST);
    // echo "<pre>";
    // print_r($errors);
    // echo "</pre>";
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
include("./includes/template/header.php");
?>
<div class="row container" style="margin: 100px auto !important;">
    <img class="col-lg-5 d-none d-lg-block" src="./img/Developer activity-bro.png"></img>
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

<?php include("./includes/template/footer.php") ?>