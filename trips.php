<?php
// Ulster volunteers, british paramilitary force created to covertly fight the IRA

include('includes/head.php');
include('includes/header.php');

include("Services/ActivityService.php");
include("Services/TripService.php");
include("controllers/TripController.php");
include("helpers.php");
require('includes/guzzle.php');
session_start();
$tService = new TripService(newClient());
$tController = new TripController($tService);


$allTrips = null;
$allTrips = $tController->getEntries();
$trips = $allTrips;
// print_r($trips);


if($allTrips) {

	if(isset($_POST['trip_search'])) {
		$owner = $_POST['owner'];
		$activity = $_POST['activity'];
		
		if($owner && $activity) {
			$trips = array_map('getBoth', $allTrips);
		} else if ($owner){
			$trips = array_map('getByOwner', $allTrips);
		} else if ($activity){
			$trips = array_map('getByActivity', $allTrips);
		} // else dont change $trips at all 
		

		
	}


?>
	<style type="text/css">
		.trip-search {
			padding: .5em;
		}
		.trip-search select {
			margin-left: .5em;
		}
		.trips-display {
			font-size: 10px;
			line-height: 4px;
			background: #ccc;
			padding: .5em;
			margin: .5em;
			border-radius: 5px;
		}		

	</style>

	<div class="trip-search row">
		<form method="post" action="#" class="form-inline">

		<div class="form-group col-sm-5">
			<!-- <div class="row"></div> -->
			<label>Select By User:</label>
			<select class="form-control col-md-6" name="owner">
				<option value="">All Users</option>
				<?php foreach ($allTrips as $key => $value): ?>
					<option value=""><?php print $value->owner; ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="form-group col-sm-5">
			<label>Select By Activity:</label>
			<select class="form-control" name="activity">
				<option value="">All Activities</option>
				<?php foreach ($allTrips as $key => $value): ?>
					<option value=""><?php print $value->activity; ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="col-sm-2"><input type="submit" name="trip_search" value="Search Trips" class="btn btn-success btn-sm"></div>
		</form>
	</div>

	
	<?php foreach ($trips as $key => $value): ?>
		<div class="trips-display">
			<p><span class="">Owner: </span><?php echo $value->owner ?></p>
			<p><span class="">Activity: </span><?php echo $value->activity ?></p>
			<p><span class="">Name: </span><?php echo $value->name ?></p>
			<p><span class="">Desc: </span><?php echo $value->description ?></p>
			<p><span class="">Date: </span><?php echo $value->dateOf ?></p>
			<p><span class="">Rating: </span><?php echo $value->rating ?></p>
			<p><span class="">Diff: </span><?php echo $value->difficulty ?></p>
			<p><span class="">City: </span><?php echo $value->city ?></p>
			<p><span class="">State: </span><?php echo $value->state ?></p>
			<p><span class="">latlon: </span><?php echo $value->latlon ?></p>
		</div>
	<?php endforeach ?>

	

	<div>
		
	</div>



<?php
}
else {
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";
	print "<p>trips not true</p>";

}



?>







<?php
include('includes/footer.php');
?>