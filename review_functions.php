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
	#echo " getAllReview executed/";
	}
	else {
	echo " getAllReview couldn't execute/";
	}

	// fetchAll() returns an array for all of the rows in the result set
	$results = $statement->fetchAll();

	#echo " fetched all (made array)/";

	// closes the cursor and frees the connection to the server so other SQL statements may be issued
	$statement->closeCursor();

	return $results;

}

function addReview( $username, $restaurant_id, $restaurant_name, $review_text, $rating, $date, $liked)
{
	#echo " inside addReview/";
	global $db;

	$query = $db->prepare("INSERT INTO Review (Username, Restaurant_id, Restaurant_name, Review_text, Rating, Date, Liked) VALUES( :username, :restaurant_id, :restaurant_name, :review_text, :rating, :dat, :liked)");
	#$query->bindValue(':review_id', $review_id);
	$query->bindValue(':username', $username);
	$query->bindValue(':restaurant_id', $restaurant_id);
	$query->bindValue(':restaurant_name', $restaurant_name);
	$query->bindValue(':review_text', $review_text);
	$query->bindValue(':rating', $rating);
	$query->bindValue(':dat', $date);
	$query->bindValue(':liked', $liked);

    #echo " binded all values/";

	#$query->execute();        // run query, if the statement is successfully executed, execute() returns true
	                              // false otherwise
	if ($query->execute()){
	#echo " addReview executed/";
	}
	else {
	#echo " addReview couldn't execute";
	}

	$query->closeCursor();    // release hold on this connection


    //Josh's Code
    //User_liked_restaurants
    if ($liked == "TRUE") {
    #echo 'likes';
    $query = $db->prepare("INSERT INTO User_liked_restaurants VALUES (:username, :rest_id) WHERE NOT EXISTS (SELECT * FROM User_liked_restaurants WHERE Username = :username AND Restaurant_id = :rest_id)");
    $query->bindValue(':username', $username);
	$query->bindValue(':rest_id', $restaurant_id);

    if ($query->execute()) {
        echo 'successfully liked';
        }
    }

    $query->closeCursor();

    //first insert restaurant in if not present
    $query = $db->prepare("INSERT INTO Restaurant_rating  VALUES (:r_id, :rating) WHERE NOT EXISTS (SELECT * FROM Restaurant_rating WHERE Restaurant_id = :r_id)");
    $query->bindvalue(':r_id', $restaurant_id);
    $query->bindvalue(':rating', $rating);
    if($query->execute()){
        echo "successfully checked ";
    } else {
         echo 'problem checking ';
    }

    $query->closeCursor();


    //Restaurant_rating stored procedure to update
    $query = $db->prepare("CALL updateRating()");
    if($query->execute()){
        echo "successfully updated ";
    } else {
         echo 'problem updating';
    }



    $query = "SELECT * FROM Review WHERE Username = :username AND Restaurant_id = :rest_id AND Review_text=:rev_text ";
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
    $statement->bindValue(':rest_id', $restaurant_id);
    $statement->bindValue(':rev_text', $review_text);
	#$statement->execute();

	if ($statement->execute()){
	#echo " getAllReview executed/";
    #echo "<br>checked in Reviews<br>";
    $tmp = $statement->fetch(PDO::FETCH_ASSOC);
    if (!empty($tmp)){
        #echo '<br> in here now<br>';
        $query = "INSERT INTO Restaurant_reviews VALUES (:r_id, :rev_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(':r_id', $restaurant_id);
        #echo $tmp['Review_id'];
        $statement->bindValue(':rev_id', $tmp['Review_id']);
        if ($statement->execute()){
            #echo '<br>successive<br>';
        }
    }
	}
	else {
	#echo " <br>review couldn't check<br>";
	}

	// fetchAll() returns an array for all of the rows in the result set


	#echo " fetched all (made array)/";

	// closes the cursor and frees the connection to the server so other SQL statements may be issued
	$statement->closeCursor();

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

 //THE HARD CODED ONE THAT EXECUTES - for testing connection between review.php and review_function
function updateReview()
{

echo " inside updateReviewWWWWWWWWW/";

global $db;

	$query = "UPDATE Review SET Review_text='THIS IS HARD CODED yessirre' WHERE Review_id=2";
    $statement = $db->prepare($query);
	$statement->execute();
}
*/

// COMMENTED OUT CAUSE IT DOESN'T WORK


function updateReview($review_id, $review_text, $rating, $date)
{
	global $db;

	$query = "UPDATE Review SET Review_text=:review_text, Rating=:rating WHERE Review_id=:review_id";
	$statement = $db->prepare($query);
	$statement->bindValue(':review_id', $review_id);
	$statement->bindValue(':review_text', $review_text);
	$statement->bindValue(':rating', $rating);
	#$statement->bindValue(':date', $date);
	#$statement->execute();

	if ($statement->execute()){
	echo " updateReview executed/";
	}
	else {
	echo " updateReview couldn't execute/";
	}
	$statement->closeCursor();


}



// COMMENTED OUT CAUSE IT DOESN'T WORK
/*
function updateReview($review_id, $username, $restaurant_id, $restaurant_name, $review_text, $rating, $date, $liked)


{

    echo " inside updateReview/"
	global $db;


	//INTENDED ONE
    $query = "UPDATE Review SET Username = :username, Restaurant_id = :restaurant_id, Restaurant_name = :restaurant_name, Review_text=:review_text, Rating=:rating, Liked = :liked WHERE Review_id=:review_id";



	//HARD CODED ONE - works if function has no parameters
	//$query = "UPDATE Review SET Username = 'new1', Restaurant_id = '33', Restaurant_name = '22rest', Review_text='22test', Rating='33', Liked = 'false' WHERE Review_id= 2";
	$statement = $db->prepare($query);


	$statement->bindValue(':review_id', $review_id);
	$statement->bindValue(':username', $username);
	$statement->bindValue(':restaurant_id', $restaurant_id);
	$statement->bindValue(':restaurant_name', $restaurant_name);
	$statement->bindValue(':review_text', $review_text);
	$statement->bindValue(':rating', $rating);
	$statement->bindValue(':date', $date);
	$statement->bindValue(':liked', $liked);

    echo " updateReview binded values/";

	$statement->execute();

	$statement->closeCursor();
}


*/




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
