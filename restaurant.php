<?php

function makeRestaurant($name, $type, $phone, $price){

    global $db;

    $query = $db->prepare('INSERT INTO Restaurant (name, food_type, phone_number, price) VALUES ( :name, :food_type, :phone_number, :price)');
    #$query->bindValue(":name", $name);
    #$query->bindValue(":food_type", $type);
    #$query->bindValue(":phone_number", $phone);
    #$query->bindValue(":price", $price);
    echo "hi";
    if ($query->execute(['name' => $name, 'food_type' => $type, 'phone_number' => $phone, 'price' => $price])){
    echo "this happened";
    }
    else {
    echo "Unable to create record";
    }
    $query->closeCursor();
}

function displayRestaurants()
{
  global $db;
  $results = null;
  $query = 'SELECT * FROM Restaurants';
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

function filterRestaurants($name){
    global $db;
    $val = '';
    $query = $db->prepare('SELECT  * FROM Restaurant WHERE lower(name) like ? ');
    #$query->bindValue(":name", lower($name));
    $var = ("%$name%");
    #echo "hi";
    if ($query->execute([$var])){
    #echo "this happened";
    $val = $query->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
    echo "Unable to get record";
    }
    $query->closeCursor();
    return $val;
}
 ?>
