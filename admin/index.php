<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lumino - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"] === "POST") {
    include("./conn.php");
    $pass = $_POST["password"];
    $select = "SELECT permission FROM users WHERE password = '$pass' AND ";
    if(str_contains($_POST["email_or_user"], "@")) {
      $email = $_POST["email_or_user"];
    } else {
      $user = $_POST["email_or_user"];
    }
    if(isset($email)) $result = $conn->query($select."email = '$email'");
    if(isset($user)) $result = $conn->query($select."user_name = '$user'");
    
    $permission = @$result->fetch_assoc()["permission"];
		if($permission == 1) {
			$_SESSION["login"] = $_POST["email_or_user"];
			header("location:dashboard.php");
		} elseif($permission == 2 || $permission == 3) {
      $message = "You do not have the required permissions.";
    } else {
      $message = "Invalid username or password.";
    }
	};
	?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form" method="POST" action="<?=$_SERVER["PHP_SELF"]?>">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="user name or E-mail" name="email_or_user" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>

							<?php if(isset($message)) {
                echo "<div class='alert alert-danger'>$message</div>";
              } ?>
							

							<button type="submit" class="btn btn-primary">Login</button>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
