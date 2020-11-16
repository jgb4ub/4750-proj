<?php
// Include config file
require("projectconnectdb.php");
require("profilefunctions.php");
//session_start();
//$username = $_SESSION['username'];
//$restaurantResults = getReviewedRestaurants("byakobowitzl");
$reviews = getReviews("byakobowitzl");
$likedreviews = getLikedReviews("byakobowitzl");
$likedrestaurants = getLikedRestaurants("byakobowitzl");
//$reviewedrest = getReviewedRestaurants("byakobowitzl");
$avgRating = getAverageRating("byakobowitzl");
$username = "byakobowitzl";

$oneStar = " &#9733";
$twoStars = " &#9733 &#9733";
$threeStars = " &#9733 &#9733 &#9733";
$fourStars = " &#9733 &#9733 &#9733 &#9733";
$fiveStars = " &#9733 &#9733 &#9733 &#9733 &#9733";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>My Profile</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.accordion .card {
	border-radius: 0;
	background: none;
	border-left-width: 0;
	border-right-width: 0;
}
.accordion .card .card-header {
	background: none;
	padding-top: 7px;
	padding-bottom: 7px;
	border-radius: 0;
}
.accordion .card-header h2 {
	font-size: 1rem;
	font-family: "Roboto", sans-serif;
}
.accordion .card-header .btn {
	color: #007bff;
	width: 100%;
	text-align: left;
	padding-left: 0;
	padding-right: 0;
}
.accordion .card-header i {
	font-size: 1.3rem;
	position: absolute;
	top: 15px;
	right: 1rem;
}
.accordion .card-header .btn:hover {
	color: #0069d9;
}
.accordion .card-body {
	color: #666;
}
.accordion .highlight i {
	transform: rotate(180deg);
}
.header{
    padding: 10px;
    margin: 20px
}
.text {
  font-family: Arial, Helvetica, sans-serif;
}

</style>
<script>
$(document).ready(function(){
	// Add minus icon for collapse element which is open by default
	$(".collapse.show").each(function(){
		$(this).prev(".card-header").addClass("highlight");
	});

	// Highlight open collapsed element
	$(".card-header .btn").click(function(){
		$(".card-header").not($(this).parents()).removeClass("highlight");
		$(this).parents(".card-header").toggleClass("highlight");
	});
});
</script>
</head>
    <body>
<div class="container">
    <!-- <div>
        <h2>My Profile<h2>
    </div> -->
    <div>
        <p class = "text">You are currently logged in as: <?php echo $username ?></p>
        <p class = "text">Your average rating across all restaurants is: <?php foreach ($avgRating as $item): echo $item['Avg_rating']; endforeach ?></p>
        <!-- <p class = "text"><?php foreach ($reviewedrest as $item): echo $item['Restaurant_name']; endforeach ?></p> -->
    </div>
	<div class="row">
		<div class="col-lg-8 offset-lg-2">
			<div class="accordion mt-5" id="accordionExample">
				<div class="card">
					<div class="card-header" id="headingTwo">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">My Reviews:<i class="fa fa-angle-down"></i></a>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body" display= "inline-block" vertical-align = "middle">
                            <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
                              <?php foreach ($reviews as $item): ?>
                              <tr>
                                <td>
                                    <h3><?php echo $item['Restaurant_name'];
                                    if ($item['Rating'] == 1){
                                        echo html_entity_decode($oneStar);
                                    }
                                    if ($item['Rating'] == 2){
                                        echo html_entity_decode($twoStarsStar);
                                    }
                                    if ($item['Rating'] == 3){
                                        echo html_entity_decode($threeStars);
                                    }
                                    if ($item['Rating'] == 4){
                                        echo html_entity_decode($fourStars);
                                    }
                                    if ($item['Rating'] == 5){
                                        echo html_entity_decode($fiveStars);
                                    }
                                     ?><h3>
                                    <tr>
                                        <td>
                                            <p class="text"> <?php echo $item['Review_text']; ?></p>
                                        </td>
                                    </tr>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </table>
                        </div>
					</div>
				</div>
				<div class="card">
					<div class="card-header" id="headingThree">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Reviews I've liked: <i class="fa fa-angle-down"></i></a>
						</h2>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						<div class="card-body">
                            <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
                              <?php foreach ($likedreviews as $item): ?>
                              <tr>
                                <td>
                                    <h3><?php echo $item['Restaurant_name'];
                                    if ($item['Rating'] == 1){
                                        echo html_entity_decode($oneStar);
                                    }
                                    if ($item['Rating'] == 2){
                                        echo html_entity_decode($twoStarsStar);
                                    }
                                    if ($item['Rating'] == 3){
                                        echo html_entity_decode($threeStars);
                                    }
                                    if ($item['Rating'] == 4){
                                        echo html_entity_decode($fourStars);
                                    }
                                    if ($item['Rating'] == 5){
                                        echo html_entity_decode($fiveStars);
                                    }
                                     ?><h3>
                                    <tr>
                                        <td>
                                            <p class="text"><?php echo $item['Review_text']; ?></p>

                                        <td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="text">Author: <?php echo $item['Username']; ?></p>
                                        </td>
                                    </tr>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </table>
                        </div>
					</div>
				</div>
                <div class="card">
					<div class="card-header" id="headingFour">
						<h2 class="mb-0">
							<a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Restaurants I've Liked: <i class="fa fa-angle-down"></i></a>
						</h2>
					</div>
					<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
						<div class="card-body">
                            <table class="w3-table w3-bordered w3-card-4 center" style="width:100%">
                              <?php foreach ($likedrestaurants as $item): ?>
                              <tr>
                                <td>
                                    <h3><?php echo $item['Name'];?></h3>
                                    <tr>
                                        <td>
                                            <p class="text"> <?php echo $item['Food_type']; ?></p>
                                        </td>
                                    </tr>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </table>

                        </div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
</body>

</html>
