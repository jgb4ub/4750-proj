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


?>
