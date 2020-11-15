<?php

// function getReviewedRestaurants($username)
// {
//     echo "hi";
//     global $db;
//     $results = null;
//     $query = $db->prepare('SELECT Restaurant_name FROM Review WHERE Username = :username');
//     $query->bindValue(":username", $username);
//     if ($query->execute()){
//     echo "this happened";
//     }
//     else {
//     echo "Unable to get restaurant";
//     }
//     $count = $query->rowCount();
//      if ($count > 0) {
//          echo "more than 0";
// //   / output data of each row
//  } else {
//      echo "0 results";
//  }
//      $results = $query->fetchAll();
//      $query->closeCursor();
//      foreach($results['data'] as $result) {
//          echo $result['type'], '<br>';
//      }
//
//      return $results;
// }

function getReviewedRestaurants($username)
{
  global $db;
  $results = null;
  $query = 'SELECT Restaurant_name FROM Review WHERE Username = :username';
  $query->bindValue(":username", $username);
  if($stmt = $db->prepare($query))
  {
    if($stmt->execute())
    {
      $results = $stmt->fetchAll();
    }
  };

  $stmt->closeCursor();
  return $results;
}


function getReviews($username, $restaurant_name)
{
    echo "hi";
    global $db;

    $query = $db->prepare('SELECT Review_text FROM Review WHERE Username = :username AND Restaurant_name = :restaurant_name');
    $query->bindValue(":username", $username);
    $query->bindValue(":restaurant_name", $restaurant_name);
    if ($query->execute()){
    echo "this happened";
    }
    else {
    echo "Unable to get review";
    }
    $count = $query->rowCount();
     if ($count > 0) {
         echo "more than 0";
} else {
    echo "0 results";
}
    $results = $query->fetchAll();
    $query->closeCursor();
    return $results;
}

?>
