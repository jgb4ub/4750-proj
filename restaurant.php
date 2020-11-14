<?php

function makeRestaurant($name, $type, $phone, $price){

    global $db;

    $query = $db->prepare('INSERT INTO User VALUES (:name, :food, :first_name, :last_name, :email)');
    $query->bindValue(":username", $username);
    $query->bindValue(":password", $password);
    $query->bindValue(":first_name", $first_name);
    $query->bindValue(":last_name", $last_name);
    $query->bindValue(":email", $email);
    echo "hi";
    if ($query->execute()){
    echo "this happened";
    }
    else {
    echo "Unable to create record";
    }
    $query->closeCursor();
}

 ?>
