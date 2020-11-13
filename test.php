<?php
require 'projectconnectdb.php';
require 'account.php';
$results = displayUsers();
 ?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">
  <title>DB interfacing</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />
</head>

<body>
<div class="container">

<h1>Friend book</h1>
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <?php foreach ($results as $item): ?>
  <tr>
    <td><?php echo $item['First_name']; ?></td>
  </tr>
  <?php endforeach; ?>
</table>

</div>
</body>
</html>
