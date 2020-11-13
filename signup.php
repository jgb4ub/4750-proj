<?php
// Include config file
require("projectconnectdb.php");
require("createaccount.php");



// Define variables and initialize with empty values
$username = $password = $first_name = $last_name = $email = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // if(empty(trim($_POST["username"]))){
    //     $username_err = "Please enter a username.";
    // }
    // if(empty(trim($_POST["password"]))){
    //     $password_err = "Please enter a password.";
    // }
     if (!empty($_POST['action']) && ($_POST['action'] == 'Add')){
        $param_username = trim($_POST["username"]);
        $param_password = trim($_POST["password"]);
        $param_first_name = trim($_POST["firstname"]);
        $param_last_name = trim($_POST["lastname"]);
        $param_email = trim($_POST["email"]);
      }
    //     //echo makeAccount($param_username, $param_password, $param_first_name, $param_last_name, $param_email);
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
         <p>Please fill this form to create an account.</p>
         <form action="signup.php",  method="post">
           <div class='form-group'>
             <label>First Name</label>
             <input type='text', name='firstname' class='form-control' required>
           </div>
           <div class='form-group'>
             <label>Last Name</label>
             <input type='text', name='lastname' class='form-control' required>
           </div>
           <div class='form-group'>
             <label>Email</label>
             <input type='text', name='email' class='form-control' required>
           </div>
             <div class="form-group">
                 <label>Username</label>
                 <input type="text" name="username" class="form-control" required>
             </div>
             <div class="form-group">
                 <label>Password</label>
                 <input type="password" name="password" class="form-control" required>
             </div>
             <div class="form-group">
                 <input type="submit" value='Add', name='action' class="btn btn-primary" title="Submit">
                 <input type="reset" name='action' class="btn btn-default" title="Reset">
             </div>
             <p>Already have an account? <a href="login.php">Login here</a>.</p>
         </form>
     </div>
 </body>
 </html>
