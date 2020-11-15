<?php
require 'projectconnectdb.php';
require 'account.php';
$username = $password = '';
$login_err = "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  if (authenticate($username, $password)){

    echo " yayyy/";
    /// add redirect link to profile.php
  } else {
    $login_err = "Invalid username or password.";
  }
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px;
                  margin: 0 auto;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Log In</h2>
        <form action="login.php" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <span type='help-block' color='red'> <?php echo $login_err; ?> </span>
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
        </form>
    </div>
</body>
</html>
