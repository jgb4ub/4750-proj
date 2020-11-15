<?php


session_start();
require 'account.php';
require 'projectconnectdb.php';
require 'review_functions.php';


$reviews = getAllReviews($_SESSION["username"]); // an array of arrays for displaying the table of the user's reviews
$review_to_update = null; //sets equal to review_id after clicking update, then is set to an array of the row for that reivew_id

echo "Welcome " . $_SESSION["username"] . "/";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

    if (!empty($_POST['action']) && ($_POST['action'] == 'Update'))
	{
		$review_to_update = getReviewById($_POST['review_to_update']); // an array of the row for that review

		echo "review_id: " . $_POST['review_to_update']; //show which review_id we are updating
	}

	else if (!empty($_POST['action']) && ($_POST['action'] == 'Submit'))
	{
		addReview($_POST['review_id'], $_SESSION["username"], $_POST['restaurant_id'], $_POST['restaurant_name'], $_POST['review_text'],
		$_POST['rating'], $_POST['date'], $_POST['liked']);
		$reviews = getAllReviews($_SESSION["username"]); // update the table after adding new review

		print_r ($reviews); // show us what's in the user's table
	}


	else if (!empty($_POST['action']) && $_POST['action'] == 'Delete')
	{
	    echo " Delete button clicked";
		echo " review to delete: " . $_POST['review_to_delete'];      // see what value is stored
		deleteReview($_POST['review_to_delete']);

		echo " deleted it";

		$reviews = getAllReviews($_SESSION["username"]);
	}


	if (!empty($_POST['action']) && ($_POST['action'] == 'Confirm update'))
	{

		updateReview($_POST['review_id'], $_SESSION['username'], $_POST['restaurant_id'], $_POST['restaurant_name'], $_POST['review_text'], $_POST['rating'], $_POST['date'], $_POST['liked']);

		$reviews = getAllReviews($_SESSION["username"]); //update the table after updating the review


	}




}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Restaurant Review</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>
<div class="container">


<div style ="width: 700px; padding: 20px; margin: 0 auto";>

<h1>Write a Review</h1>

<form name="mainForm" action="review.php" method="post" >
  <div class="form-group" >
    <label> Review Id </label>
    <input style="width: 200px"; type="number" class="form-control" name="review_id"
     value="<?php if ($review_to_update!=null) echo $review_to_update[0] ?>"

    />
  </div>


  <div class="form-group">
    <label> Restaurant Id </label>
    <input style="width: 200px"; type="number" class="form-control" name="restaurant_id"
     value="<?php if ($review_to_update!=null) echo $review_to_update[2] ?>"

    />
  </div>

  <div class="form-group">
    <label> Restaurant Name </label>
    <input style="width: 400px"; type="text" class="form-control" name="restaurant_name"
     value="<?php if ($review_to_update!=null) echo $review_to_update[3] ?>"

    />
  </div>

  <div class="form-group">
    <label> Date </label>
    <input style="width: 200px"; type="text" class="form-control" name="date"
     value="<?php if ($review_to_update!=null) echo $review_to_update[6] ?>"

    />
  </div>

  <div class="form-group">
    <label> Liked </label>
    <input style="width: 200px"; type="text" class="form-control" name="liked"
     value="<?php if ($review_to_update!=null) echo $review_to_update[7] ?>"

    />
  </div>

  <div class="form-group">
    <label> Rating </label>
    <input style="width: 100px"; type="number" class="form-control" name="rating"
    value="<?php if ($review_to_update!=null) echo $review_to_update[5] ?>"

    />
  </div>

  <div class="form-group">
    <label> How was your experience? </label>
    <textarea id="review_text" name="review_text" rows="4" cols="50"><?php if ($review_to_update!=null) echo $review_to_update[4] ?></textarea>
  </div>

  <input type="submit" value="Submit" name="action" class="btn btn-dark" title="Insert a review into a review table" />
  <input type="submit" value="Confirm update" name="action" class="btn btn-dark" title="Confirm update a review" />

</form>



<hr/>
<h2>My Reviews</h2>
<table class="w3-table w3-bordered w3-card-4 center" style="width:110%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Review Id</th>
    <th width="25%">Username</th>
    <th width="25%">Restaurant Id</th>
    <th width="25%">Restaurant Name</th>
    <th width="25%">Review Text</th>
    <th width="25%">Rating</th>
    <th width="25%">Date</th>
    <th width="25%">Liked</th>
    <th width="10%">Update?</th>
    <th width="10%">Delete?</th>
  </tr>
  </thead>
  <?php foreach ($reviews as $item): ?>
  <tr>
    <td><?php echo $item[0]; ?></td>


    <td><?php echo $item[1]; ?></td>
    <td><?php echo $item[2]; ?></td>
    <td><?php echo $item[3]; ?></td>
    <td><?php echo $item[4]; ?></td>
    <td><?php echo $item[5]; ?></td>
    <td><?php echo $item[6]; ?></td>
    <td><?php echo $item[7]; ?></td>



    <td>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Update" name="action" class="btn btn-primary" title="Update the record" />
        <input type="hidden" name="review_to_update" value="<?php echo $item[0] ?>" />

      </form>
    </td>
    <td>


    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Delete" name="action" class="btn btn-danger" title="Permanently delete the record" />
        <input type="hidden" name="review_to_delete" value="<?php echo $item[0] ?>" />

     </form>

    </td>
  </tr>
  <?php endforeach; ?>
</table>
<div/>
</div>
</body>
</html>





