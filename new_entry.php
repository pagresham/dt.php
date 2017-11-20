<?php

include('includes/head.php');
include('includes/header.php');

include("Services/TripService.php");
include("helpers.php");
require('includes/guzzle.php');
require('controllers/Control.php');
require('controllers/TripController.php');


$allActivities = null;

$tripService = new TripService(newClient());
$tripController = new TripController($tripService);

$name= $description= $date= $rating= $difficulty= $city= $state= $lat= $lon= "";

if(isset($_POST['submit_trip'])) {
	// $strippedPost = htmlspecialchars($_POST);
	$strippedPost = array_map('htmlspecialchars', $_POST);
	$res = $tripController->validateTrip($strippedPost);
	if($res) {
		header("Location: trips.php");
	}
}


?>

<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<script type="text/javascript" src="assets/js/location.js"></script>
<div class="container-fluid">
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJl1s_ElOQABn5g9toMSrBQoKtBPv6NFs"></script>

	<form method="post" action="#">
	<div class="row">
		
		<div class="col-sm-6" style="height: 29.1em;" id="checkht">
			<h4>Description</h4>
			<div class="form-group">
			    <label for="tname">Name</label>
			    <input name="tname" type="text" class="form-control" id="tname" placeholder="Name you trip" required value="<?php echo isset($_POST['tname']) ? trim($_POST['tname']) : "" ?>">
			    <small id="emailHelp" class="form-text text-muted">We know it was a great one!</small>
	  		</div>
			<div class="form-group">
			    <label for="description">Description</label>
			    <textarea name="description" class="form-control" id="description" rows="2"  required><?php echo isset($_POST['description']) ? trim($_POST['description']) : "" ?></textarea>
				<!-- <input type="text" name="description" class="form-control" id="description" value="<?php //echo isset($_POST['description']) ? $_POST['description'] : "" ?>" style="height: 4em;"> -->
			</div>
			<div class="form-group">
			    <label for="date">Date Of Trip</label>
			    <input name="date" type="date" class="form-control" id="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : "" ?>">
			</div  required>

			<div class="form-inline">
		    	<label for="rat">Fun Rating:
		    		<span type="text" name="rat" id="rat" style="width:3em;margin-left:1em;">5</span>
		    	</label>
				
				<input name="rating" class="form-control" type="range" id="rating" min="1" max="10" style="width:100%;" value="<?php echo isset($_POST['rating']) ? $_POST['rating'] : "" ?>">
			</div>
		  	<div class="form-inline">
		    	<label for="description">Difficulty:
		    		<span type="text" name="diff" id="diff" style="width:3em;margin-left:1em;">5</span>
		    	</label>
				
				<input name="difficulty" class="form-control" type="range" id="difficulty" min="1" max="10" style="width:100%;" value="<?php echo isset($_POST['difficulty']) ? $_POST['difficulty'] : "" ?>">
			</div>
		</div>
	
	  
		<div class="col-sm-6" style="height: 29.1em;position:relative">
			<h4>Location</h4>
			<div class="form-group">
			    <label for="city">City</label>
			    <input name="city" type="text" class="form-control" id="city" placeholder="City" value="<?php echo isset($strippedPost['city']) ? $strippedPost['city'] : "" ?>">
			</div>
		    <div class="form-group">
		        <label for="state">State</label>
		        <input name="state" type="text" class="form-control" id="state" placeholder="State" value="<?php echo isset($strippedPost['state']) ? $strippedPost['state'] : "" ?>">
		    </div>

			<div class="row">
				<div class="form-group col-6">
			    	<input name="lat" type="text" class="form-control" id="lat" readonly placeholder="Lattitude" value="<?php echo isset($_POST['lat']) ? $_POST['lat'] : "" ?>">
			    </div>
				<div class="form-group col-6">
			    	<input name='lon' type="text" class="form-control" id="lon" readonly placeholder="Longitude" value="<?php echo isset($_POST['lon']) ? $_POST['lon'] : "" ?>">
			    </div>
			</div>
		    <div class="row">
		    	<div class="col-6">
		    		<button type="button" class="btn btn-sm btn-info" id="check_latlon">Check Lat/Lon</button>	
		    	</div>
		    	<div class="col-6">
		    		<button type="submit" class="btn btn-sm btn-success" name="submit_trip" formnovalidate="">Submit</button>	
		    	</div>
			</div>
		</div>
	</div> <!-- end row -->
	
	</form>
	
</div> <!-- end container -->





<?php
include('includes/footer.php');
?>