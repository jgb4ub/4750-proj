<?php
require 'projectconnectdb.php';
require 'review_functions.php';

$review_to_update = null;


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	/*
	if (!empty($_POST['action']) && ($_POST['action'] == 'Update'))
	{
		$friend_to_update = getFriendInfo_by_name($_POST['friend_to_update']);
	}

	*/

	if (!empty($_POST['action']) && ($_POST['action'] == 'Submit'))
	{
		addReview($_POST['review_id'], $_POST['username'], $_POST['restaurant_id'], $_POST['restaurant_name'], $_POST['review_text'],
		$_POST['rating'], $_POST['date'], $_POST['liked']);
		$reviews = getAllReviews();
	}

	/*
	else if (!empty($_POST['action']) && $_POST['action'] == 'Delete')
	{
		// echo $_POST['friend_to_delete'];      // see what value is stored in a form element named "friend_to_delete"
		deleteReview($_POST['friend_to_delete']);
		$reviews = getAllReviews();
	}

	if (!empty($_POST['action']) && ($_POST['action'] == 'Confirm update'))
	{
		updateReview($_POST['name'], $_POST['major'], $_POST['year']);
		$reviews = getAllReviews();
	}

    */
}



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurant Reviews</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 600px; padding: 20px;
                  margin: 0 auto;}
    </style>
</head>


<body>
    <div class="wrapper">
        <h2 style="padding-bottom: 20px;">Write a Review</h2>
        <form action="review.php" method="post">

            <div class="form-group">
            Review Id:
            <input type="text" class="form-control" name="review_id" required

            />

            <div class="form-group">
            Username:
            <input type="text" class="form-control" name="username" required

            />

            <div class="form-group">
            Restaurant Id:
            <input type="text" class="form-control" name="restaurant_id" required

            />
            <div class="form-group">
            Date:
            <input type="text" class="form-control" name="date" required

            />
            <div class="form-group">
            Liked:
            <input type="text" class="form-control" name="liked" required

            />

            <div class="form-group">
            <label> Restaurant </label>
            <input style="width: 400px;" type="text" name="restaurant_name" class="form-control" required

            />

            </div>
            <div class="form-group">
                <label>Rating</label>
                 <select style="width: 60px;" class="form-control text-center" name="rating">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                  </select>
            </div>

            <div class="form-group">
                <label>How was your experience?</label>
                <textarea id="review_text" name="review_text" rows="4" cols="50">testing22

                </textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="action" class="btn btn-primary" value="Submit">

            </div>

        </form>



            <hr/>
            <h2>My Reviews</h2>
            <table class="w3-table w3-bordered w3-card-4 center" style="width:600px">
              <thead>
              <tr style="background-color:#B0B0B0">
                <th width="200px">Restaurant</th>
                <th width="150px">Review</th>
                <th width="100px">Rating</th>
                <th width="100px">Date</th>
                <th width="50px">Liked</th>
               <!--
               <th width="20%">Update</th>
                <th width="20%">Delete</th>
                -->


              </tr>
              </thead>
              <?php foreach ($reviews as $item): ?>
              <tr>
                <td><?php echo $item['restaurant_name']; ?></td>
                <td><?php echo $item['review_text']; ?></td>
                <td><?php echo $item['rating']; ?></td>
                <td><?php echo $item['date']; ?></td>
                <td><?php echo $item['liked']; ?></td>
                <td>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="submit" value="Update" name="action" class="btn btn-primary" title="Update the record" />
                    <input type="hidden" name="review_to_update" value="<?php echo $item['restaurant_name'] ?>" />
                  </form>
                </td>
                <td>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="submit" value="Delete" name="action" class="btn btn-danger" title="Permanently delete the record" />
                    <input type="hidden" name="review_to_delete" value="<?php echo $item['restaurant_name'] ?>" />
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            </table>


    </div>



</body>
</html>



