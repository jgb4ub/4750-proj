<?php


session_start();
require 'account.php';
require 'projectconnectdb.php';
require 'review_functions.php';


echo "Welcome " . $_SESSION["username"] . "/";

$avg = null;


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (!empty($_POST['action']) && ($_POST['action'] == 'Average'))

	{
	    echo " avg button clicked/";

		$avg = avgRating($_SESSION["username"]);

		 if(!raterExists($_SESSION["username"]))
		 {
		   echo "DOESNT";
		  // echo $avg[1];
		   //addRater($_SESSION["username"], $avg[1]);
		 }


	}


}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Average Rating</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
  <div class="container">
  <h2>My Average Ratings</h2>

  <table class="w3-table w3-bordered w3-card-4 center" style="width:30%">
    <tr style="background-color:#B0B0B0">
        <th width="25%">User</th>
        <th width="25%">Average Rating</th>
    <tr>

    <tr>
    <td><?php echo $avg[0]; ?></td>
    <td><?php echo $avg[1]; ?></td>

    <tr>



  </table>



        <div style ="width: 700px; padding: 20px; margin: 0 auto";>


            <form name="mainForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" >


              <input type="submit" value="Average" name="action" class="btn btn-dark" title="Calculate User's Average Rating" />

            </form>


        <div/>
    </div>
</body>
</html>





