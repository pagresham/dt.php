<?php

function printUsers($myarr) {
	print "<table class='table'>";
	print "<tr><th>_id</th><th>uname</th><th>email</th><th></th><tr>";
	foreach ($myarr as $key => $value) {
		print "<form method='post' action='#'>";
		print "<tr>";
		print "<td>". $value->uname ."</td>";
		print "<td>". $value->email ."</td>";
		print "<td>". $value->_id ."</td>";
		print "<input type='hidden' name='_id' value='". $value->_id ."'/>";
		print "<td><button type='submit' name='edit_user' class='btn btn-sm'>Edit User</button></td>";
		print "</tr>";
		print "</form>";
	}
	print "</table>";
}

function printActivities($arr) {
	print "<h2>Activities</h2>";
	print "<table border=1>";
	print "<tr><th>_id</th><th>name</th><th>Create Date</th></tr>";
	foreach ($arr as $key => $value) {
		if(isset($value->name)) {
			print "<tr>";
			print "<td>". $value->_id ."</td>";
			print "<td>". $value->name ."</td>";
			print "<td>". $value->create_date ."</td>";
			print "</tr>";	
		}
	}
	print "</table>";
}

function printUser($user) {
	print "<div>";
		print "<p>Username:  " . $user->uname . "</p>";
		print "<p>email:  " . $user->email . "</p>";
		print "<p>_id:  " . $user->_id . "</p>";
	print "</div>";
}

function entriesTable($arr, $headers) {

	print "<h2>Entries</h2>";
	print "<table class='table'>";
	
	print "<tr>";
	
	foreach ($headers as $key => $value) {
		print "<th>". $value ."</th>";
	}
	print "</tr>";
	
	foreach ($arr as $key => $value) {
		
			print "<tr>";
			print "<td>". $value->_id ."</td>";
			print "<td>field2</td>";
			print "<td>field3</td>";
			print "</tr>";	
		
	}
	print "</table>";
}

	// Used to filter search results in trips.php
	function getByBoth($t, $a, $o) {
		$newArr = [];
		foreach ($t as $trip) {
			if ($trip->owner == $o && $trip->activity == $a) {
				$newArr[] = $trip;	
			}
		}
		return $newArr;
	}


	function getByOwner($t, $o) {
		$newArr = [];
		foreach ($t as $trip) {
			if ($trip->owner == $o) {
				$newArr[] = $trip;	
			}
		}
		return $newArr;
	}
	function getByActivity($t, $a) {
		$newArr = [];
		foreach ($t as $trip) {
			if ($trip->activity == $a) {
				$newArr[] = $trip;	
			}
		}
		return $newArr;
	}


	// Used to populate activity drop down on new_entry
	function getAct($t) {
		return $t->activity;
	} 
	function getOwner($t) {
		return $t->owner;
	} 


	function printP($arg) {
		print "<p>" . $arg . "</p>";
	}

	function getUniqueActivities($t) {
		$activities = array_map("getAct", $t);
		$uniqueActivities = array_unique($activities);
		return $uniqueActivities;
	}

	function getUniqueOwners($t) {
		$owners = array_map("getOwner", $t);
		$uniqueOwners = array_unique($owners);
		return $uniqueOwners;
	}



?>









