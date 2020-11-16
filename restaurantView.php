<?php
#require 'projectconnectdb.php';
require 'restaurant.php';
require 'userLikedReviews.php';

//$liked = '';
$revs = '';
if (empty($_POST['rev_id'])){
    $_POST['rev_id'] = '';
}

// if (empty($_POST['rest_id'])){
//     $_POST['rest_id'] = '';
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($_POST['rev_id']){
        userLikeReview($_POST['rev_id']);
    }
    if (isset($_POST['rest_id'])) {
        $revs = renderRestaurantReviews($_POST['rest_id']);
        $rest = renderRestaurant($_POST['rest_id']);

    }
}
#echo $_POST['rest_id'];


// $revs = renderRestaurantReviews($_POST['rest_id']);
//
// $rest = renderRestaurant($_POST['rest_id']);
if (isset($_POST['rest_id'])){
    echo '<h1>'.htmlspecialchars($rest['Name']).'</h1>';
    echo '<h4>'.htmlspecialchars($rest['Food_type']).' | '.htmlspecialchars($rest['Price']).'</h4>';
    echo '<h4>'.htmlspecialchars($rest['Phone_number']);
}
?>
<head>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<br><br>

<?php
if ($revs != ''){
    foreach ($revs as $rev){
        echo '<br><div class="col-md-6 z-card mx-auto"><h4>'.$rev['Username'].'</h4>'.'<p>'.$rev['Review_text'].'</p></div><br><br>';
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <td>
            <input type="hidden" name="rest_id" value=<?php echo '"'.htmlspecialchars($rest['Restaurant_id']).'"'; ?>>
            <input type="hidden" name="rev_id" value=<?php echo '"'.htmlspecialchars($rev['Review_id']).'"'; ?>>
            <input type="submit" class="form-control" name="Like" value="Like">
        </td>
        </form>
    <?php
        #print_r($rev);
        #foreach($rev as $tmp){echo $tmp.'  ';}
    }
}
else{

}
 ?>
