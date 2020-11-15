<?php
// Include config file
require("projectconnectdb.php");
require("profilefunctions.php");
session_start();
echo $_SESSION['username'];
//$restaurantResults = getReviewedRestaurants("byakobowitzl");
$reviews = getReviews("byakobowitzl");
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
<title>My Profiles</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
.logoutLblPos{

   position:fixed;
   right:10px;
   top:5px;
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
<form align="right" method="post" action='logout.php'>
	<label class='logoutLblPos'>
		<input name='logout' type='submit' value='Logout'>
	</label>
</form>

</head>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="searchRestaurants.php">Restaurants</a></li>
      <li><a href="#">Reviews</a></li>
      <li><a href="profile.php">Profile</a></li>
    </ul>
  </div>
</nav>
<body>

<div class="container">
    <div class="header">
    <h2 font-family: "Roboto", sans-serif;>My Reviews:</h2>
    <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
      <?php foreach ($reviews as $item): ?>
      <tr>
          <div class="row">
      		<div class="col-lg-8 offset-lg-2">
      			<div class="accordion mt-5" id="accordionExample">
      				<div class="card">
      					<div class="card-header" id="headingOne">
      						<h2 class="clearfix mb-0">
      							<a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php echo $item['Restaurant_name'];
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
                                    }?><i class="fa fa-angle-down"></i></a>
      						</h2>
      					</div>
      					        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      						<div class="card-body"><?php echo $item['Review_text']; ?></div>
      					</div>
      				</div>
                </div>
            </div>
        </div>
      </tr>
      <?php endforeach; ?>
    </table>

</div>
</div>
</body>
</html>