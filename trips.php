<?php
include('includes/head.php');
include('includes/header.php');

$tService = new TripService(newClient());
$tController = new TripController($tService);

$allTrips = null;
$allTrips = $tController->getEntries();
$trips = $allTrips;
// print_r($trips);


if($allTrips) {
print_r(getUniqueActivities($allTrips));
	if(isset($_POST['trip_search'])) {
		// print_r($_POST);
		$owner = $_POST['owner'];
		$activity = $_POST['activity'];
		// getTrip($t, $a, $o)
		if($owner && $activity) {
			printP("Owner and activity");
			$trips = getByBoth($allTrips, $activity, $owner);
		} else if ($owner){
			printP("Owner");
			$trips = getByOwner($allTrips, $owner);
		} else if ($activity){
			printP("activity");
			$trips = getByActivity($allTrips, $activity);
		} // else dont change $trips at all 
		else {
			printP("neither");
		}

		
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
<div class="container">
	<div class="trip-search">
		<form method="post" action="#" class="form-inline row">

		<div class="col-md-5 form-group">
			<!-- <div class="row"></div> -->
			<label>Select By Owner:</label>
			<select class="form-control col-md-6" name="owner">
				<option value="">All Owners</option>
				<?php foreach (getUniqueOwners($allTrips) as $key => $value): ?>
					<option value="<?php print $value; ?>"><?php print $value; ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="col-md-5 form-group">
			<label>Select By Activity:</label>
			<select class="form-control" name="activity">
				<option value="">All Activities</option>
				<?php foreach (getUniqueActivities($allTrips) as $key => $value): ?>
					<option value="<?php print $value; ?>"><?php print $value; ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="col-md-2 ml-sm-auto"><input type="submit" name="trip_search" value="Search Trips" class="btn btn-success btn-sm"></div>
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