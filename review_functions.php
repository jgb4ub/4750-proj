<?php

function getAllReviews($username)
{

    global $db;
	$query = "SELECT * FROM Review WHERE Username = :username";
	#$query = "SELECT Review_id, Restaurant_name, Review_text, Rating, Date, Liked FROM Review WHERE Username = :username";


	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$statement->execute();

	if ($statement->execute()){
	echo " getAllReview executed/";
	}
	else {
	echo " getAllReview couldn't execute/";
	}

	// fetchAll() returns an array for all of the rows in the result set
	$results = $statement->fetchAll();

	echo " fetched all (made array)/";

	// closes the cursor and frees the connection to the server so other SQL statements may be issued
	$statement->closeCursor();

	return $results;

}

function addReview($review_id, $username, $restaurant_id, $restaurant_name, $review_text, $rating, $date, $liked)
{
	echo " inside addReview/";
	global $db;

	$query = $db->prepare("INSERT INTO Review VALUES(:review_id, :username, :restaurant_id, :restaurant_name, :review_text, :rating, :date, :liked)");
	$query->bindValue(':review_id', $review_id);
	$query->bindValue(':username', $username);
	$query->bindValue(':restaurant_id', $restaurant_id);
	$query->bindValue(':restaurant_name', $restaurant_name);
	$query->bindValue(':review_text', $review_text);
	$query->bindValue(':rating', $rating);
	$query->bindValue(':date', $date);
	$query->bindValue(':liked', $liked);

    echo " binded all values/";

	$query->execute();        // run query, if the statement is successfully executed, execute() returns true
	                              // false otherwise
	if ($query->execute()){
	echo " addReview executed/";
	}
	else {
	echo " addReview couldn't execute/";
	}

	$query->closeCursor();    // release hold on this connection
}



function getReviewById($review_id)
{
	global $db;

	$query = "SELECT * FROM Review WHERE Review_id = :review_id";
	$statement = $db->prepare($query);
	$statement->bindValue(':review_id', $review_id);
	$statement->execute();

	#fetchAll() returns an array for all of the rows in the result set
	#fetch() return a row

	$results = $statement->fetch();

	$statement->closeCursor();

	return $results;
}







/*
function updateReview($review_id, $review_text, $rating, $date)
{
	global $db;

	$query = "UPDATE Review SET Review_text=:review_text, Rating=:rating WHERE Review_id=:review_id";
	$statement = $db->prepare($query);
	$statement->bindValue(':review_id', $review_id);
	$statement->bindValue(':review_text', $review_text);
	$statement->bindValue(':rating', $rating);
	$statement->bindValue(':date', $date);
	$statement->execute();

	if ($statement->execute()){
	echo " updateReview executed/";
	}
	else {
	echo " updateReview couldn't execute/";
	}
	$statement->closeCursor();
}
*/









 //the working one


function updateReview($review_id, $username, $restaurant_id, $restaurant_name, $review_text, $rating, $date, $liked)
{

echo " hjklhjklhjklhjk/";

global $db;

	//$query = "UPDATE Review SET Review_text='teeeeeeeeeeeeeeeeesting' WHERE Review_id=2";
	$query = "UPDATE Review SET Username = :username, Restaurant_id = :restaurant_id, Restaurant_name = :restaurant_name, Review_text=:review_text, Rating=:rating, Date= :date, Liked = :liked WHERE Review_id=:review_id";
    $statement = $db->prepare($query);

    $statement->bindValue(':review_id', $review_id);
	$statement->bindValue(':username', $username);
	$statement->bindValue(':restaurant_id', $restaurant_id);
	$statement->bindValue(':restaurant_name', $restaurant_name);
	$statement->bindValue(':review_text', $review_text);
	$statement->bindValue(':rating', $rating);
	$statement->bindValue(':date', $date);
	$statement->bindValue(':liked', $liked);

	$statement->execute();

	if ($statement->execute()){
	echo " updateReview executed/";
	}
	else {
	echo " updateReview couldn't execute/";
	}

	$statement->closeCursor();
}









function deleteReview($review_id)
{

	global $db;

	echo " inside deleteReview/";

	$query = "DELETE FROM Review WHERE Review_id=:review_id";
	$statement = $db->prepare($query);
	$statement->bindValue(':review_id', $review_id);
	$statement->execute();      // run query

	if ($statement->execute()){
	echo " deleteReview executed/";
	}
	else {
	echo " deleteReview couldn't execute/";
	}

	$statement->closeCursor();  // release hold on this connection
}


 ?>