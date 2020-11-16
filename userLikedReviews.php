<?php
require 'projectconnectdb.php';
session_start();
function userLikeReview($id){
    global $db;

    $query = $db->prepare('INSERT INTO User_liked_reviews VALUES  (:username, :id)');
    #$query->bindValue(":name", $name);
    #$query->bindValue(":food_type", $type);
    #$query->bindValue(":phone_number", $phone);
    #$query->bindValue(":price", $price);
    #echo "hi";
    if ($query->execute(['username' => $_SESSION['username'], 'id' => $id])){
    echo "Review Liked";
    }
    else {
    echo "Unable to create record";
    }
    $query->closeCursor();
}
 ?>
