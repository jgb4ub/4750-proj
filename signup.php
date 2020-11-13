<?php
// Include config file
require_once "projectconnectdb.php";
include "createaccount.php";

// Define variables and initialize with empty values
$username = $password = $first_name = $last_name = $email"";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    }
    else{
        $param_username = trim($_POST["username"]);
        $param_password = trim($_POST["password"]);
        $param_first_name = trim($_POST["first_name"]);
        $param_last_name = trim($_POST["last_name"]);
        $param_email = trim($_POST["email"]);

        echo makeAccount($param_username, $param_password, $param_first_name, $param_last_name, $param_email);
    }
}
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
            <div>
                <label>Username</label>
            </div>
            <div>
                <label>Password</label>
            </div>
            <div>
                <label>Confirm Password</label>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account?</p>
        </form>
    </div>
</body>
</html>
