<?php
require("projectconnectdb.php");
require("restaurant.php");
session_start();
echo $_SESSION['username'];
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>
 <style>
     .error {color: #FF0000;}
     th, td {
         padding: 10px;
    }
 </style>
 </head>
 <body>
<?php
$name = $type = $phone = $price = $restaurantList =$nameErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Please enter a search query";

    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
        if ($nameErr == ""){
        $restaurantList = filterRestaurants($name);
    }

} else{
    $restaurantList = "";
}

//$liked = false


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<h1> Restaurant Search </h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Restaurant Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<h2> Restaurants Found: </h2><hr><br><br>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Type</th>
    <th>Phone</th>
    <th>Price</th>
    <th>Like?</th>
  </tr>

<?php

if ($restaurantList){
    foreach ($restaurantList as $restaurant){

        echo '<tr>';
        foreach ($restaurant as $att){
            echo '<td>'.$att.'</td>';

        }
        ?>
        <form method="post" action="userLikedRestaurants.php">
        <td><input type="hidden" name="like_id" value="<?php echo $restaurant['Restaurant_id']; ?>"><input type="submit" class="form-control" name="like" value="Like"></td>
        </form>
        <?php
        echo '</tr>';
        #echo print_r($restaurant['Restaurant_id']);
        #echo " | <br>";

    }
    echo '<br>';
}


?>
</table>
