<?php
require 'projectconnectdb.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['like_id'])) {
    makeUserLikedRestaurant($_POST['like_id']);

    }
}

function makeUserLikedRestaurant($rest_id){

    global $db;

    $query = $db->prepare('INSERT INTO User_liked_restaurants VALUES ( :username, :restaurant_id)');

    if ($query->execute(['username' => $_SESSION['username'], 'restaurant_id' => $rest_id])){
    echo "entered";
    }
    else {
    echo "Unable to create record";
    }
    $query->closeCursor();
}
?>
