<?php
// Include config file
require("projectconnectdb.php");
require("account.php");



$username = $first_name = $last_name = $email = $confrim_password= "";
$username_err = $password_err= $conf_password_err="";
//echo password_hash("password", PASSWORD_DEFAULT);

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // if(empty(trim($_POST["username"]))){
    //     $username_err = "Please enter a username.";
    // }
    // if(empty(trim($_POST["password"]))){
    //     $password_err = "Please enter a password.";
    // }
     if (!empty($_POST['action']) && ($_POST['action'] == 'Submit')){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $confirm_password = trim($_POST['confrimpassword']);
        if(userExists($username)){
          $username_err='Username already exists';
        }
        if(strlen($password)< 8){
          $password_err = "Password must have at least 8 characters";
        }
        else if($password != $confirm_password){
          $conf_password_err="Passwords did not match";
        }
        else if( empty($username_err) && empty($password_err) && empty($conf_password_err)){
          $first_name = trim($_POST["firstname"]);
          $last_name = trim($_POST["lastname"]);
          $email = trim($_POST["email"]);
          $hash = crypt($password);
          makeAccount($username, $hash, $first_name, $last_name, $email);
          header("Location: http://cs.virginia.edu/~les6ye/CS4750/project/success.php");
        }

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
         .wrapper{ width: 350px; padding: 20px;
                    margin: 0 auto;}
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
                 <span class='help-block'><?php echo $username_err; ?></span>
             </div>
             <div class="form-group">
                 <label>Password</label>
                 <input type="password" name="password" class="form-control" required>
                 <span class='help-block'><?php echo $password_err; ?></span>
             </div>
             <div class="form-group">
                 <label>Confirm Password</label>
                 <input type="password" name="confrimpassword" class="form-control" required>
                 <span class='help-block'><?php echo $conf_password_err; ?></span>
             </div>
             <div class="form-group">
                 <input type="submit" value='Submit', name='action' class="btn btn-primary" title="Submit">
                 <input type="reset" name='action' class="btn btn-default" title="Reset">
             </div>
             <p>Already have an account? <a href="login.php">Login here</a>.</p>
         </form>
     </div>
 </body>
 </html>
