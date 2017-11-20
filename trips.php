<?php
// Ulster volunteers, british paramilitary force created to covertly fight the IRA

include('includes/head.php');
include('includes/header.php');

include("Services/ActivityService.php");
include("Services/TripService.php");
include("controllers/TripController.php");
include("helpers.php");
require('includes/guzzle.php');

$tService = new TripService(newClient());
$tController = new TripController($tService);



$trips = $tController->getEntries();
// print_r($trips);


if($trips) {
?>

	<table class="table">
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Date</th>
			<th>Difficulty</th>
			<th>Rating</th>
			<th>City</th>
			<th>State</th>
			<th>LatLon</th>
		</tr>
		<?php foreach ($trips as $key => $value): ?>
			<tr>
				<td><?php echo $value->name ?></td>
				<td><?php echo $value->description ?></td>
				<td><?php echo $value->dateOf ?></td>
				<td><?php echo $value->rating ?></td>
				<td><?php echo $value->difficulty ?></td>
				<td><?php echo $value->city ?></td>
				<td><?php echo $value->state ?></td>
				<td><?php echo $value->latlon ?></td>
			</tr>
		<?php endforeach ?>

	</table>



<?php
}
else {
	print "trips not true";
}



?>







<?php
include('includes/footer.php');
?>