<?php

function getReviews($username)
{
  global $db;
  $results = null;
  $query = 'SELECT Restaurant_name, Review_text, Rating FROM Review WHERE Username = :username';
  //$query->bindValue(":username", $username);
  if($stmt = $db->prepare($query))
  {
    $stmt->bindValue(":username", $username);
    if($stmt->execute())
    {
      $results = $stmt->fetchAll();
    }
  };

  $stmt->closeCursor();
  return $results;
}



function getLikedReviews($username)
{
  global $db;
  $results = null;
  $query = 'SELECT Review.Restaurant_name, Review.Review_text, Review.Username, Review.Rating FROM Review JOIN User_liked_reviews ON Review.Review_id = User_liked_reviews.Review_id WHERE User_liked_reviews.Username = :username';
  //$query->bindValue(":username", $username);
  if($stmt = $db->prepare($query))
  {
    $stmt->bindValue(":username", $username);
    if($stmt->execute())
    {
      $results = $stmt->fetchAll();
    }
  };

  $stmt->closeCursor();
  return $results;
}

function getLikedRestaurants($username)
{
  global $db;
  $results = null;
  $query = 'SELECT Restaurant.Name, Restaurant.Food_type FROM Restaurant JOIN User_liked_restaurants ON Restaurant.Restaurant_id = User_liked_restaurants.Restaurant_id WHERE User_liked_restaurants.Username = :username';
  //$query->bindValue(":username", $username);
  if($stmt = $db->prepare($query))
  {
    $stmt->bindValue(":username", $username);
    if($stmt->execute())
    {
      $results = $stmt->fetchAll();
    }
  };

  $stmt->closeCursor();
  return $results;
}

function getAverageRating($username)
{
  global $db;
  $results = null;
  $query = 'SELECT Avg_rating FROM User_avg_rating WHERE Username = :username';
  //$query->bindValue(":username", $username);
  if($stmt = $db->prepare($query))
  {
    $stmt->bindValue(":username", $username);
    if($stmt->execute())
    {
      $results = $stmt->fetchAll();
    }
  };

  $stmt->closeCursor();
  return $results;
}


?>
