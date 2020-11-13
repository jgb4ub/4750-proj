<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(!empty($_POST['action']) && $_POST['action']=='Login'){
    header(loaction:'login.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Success</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px;
                   margin: 0 auto;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Success! Your account has been created.</h2>
        <p>Please login using your credentials.</p>
        <form action="success.php",  method="post">
            <div class="form-group">
                <input type="submit" value='Login', name='action' class="btn btn-primary" title="Login">
            </div>
        </form>
    </div>
</body>
</html>
