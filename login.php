<?php
  include("./includes/template/header.php");

//   include("includes/functions/conn.php");
  if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $check = "SELECT * FROM users WHERE 
    email='$email' AND
    password='$password'";
    $user_data = $conn->query($check)->fetch_assoc();
    $is_user = $conn->query($check)->num_rows === 1;
    if($is_user) {
        $_SESSION["user_data"] = $user_data;
        $sto = "['".implode( "', '", $user_data)."']";
        echo "<script>
        localStorage.setItem('user_data', $sto);
        window.location.href = 'index.php';
        </script>";
    }
    else {
      $m = "<div class='alert alert-danger'>Wrong email or password</div>";
    }
  }
  ?>
<div class="row container" style="margin: 100px auto !important;">
    <img class="col-lg-6 m-0 d-none d-lg-block" src="./img//Mobile login-rafiki.png"></img>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <form class="user" method="post">
                <div class="form-group">
                    <input required type="email" name="email" class="form-control form-control-user"
                        id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                    <input required type="password" name="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                            Me</label>
                    </div>
                </div>
                <?= isset($m)?$m:"" ?>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="register.php">Create an Account!</a>
            </div>
            <div class="text-center">
                <a class="small" href="index.php">Continuo as a visitor</a>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/template/footer.php"); ?>