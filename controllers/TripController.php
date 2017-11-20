<?PHP

// require('includes/guzzle.php');

/**
* CreateUserController - Contains method to run the create user dialog 
*/
class TripController
{
	private $ts;

	function __construct($tripService)
	{
		// parent::__construct();
		$this->ts = $tripService;
	}

	/**
	 * Validate New Trip
	 */
	function validateTrip($p) {
		$name= $description= $date= $rating= $difficulty= $city= $state= $lat= $lon= "";
		$errors = [];
		function tr($v) {
			return htmlspecialchars(trim($v));
		}
		$post = array_map("tr", $p); // get trimmed arr

		$name = $post['tname'];
		$description = $post['description'];
		$date = $post['date'];
		$rating = $post['rating'];
		$difficulty = $post['difficulty']; 
		$city = $post['city']; 
		$state = $post['state']; 
		$lat = $post['lat']; 
		$lon = $post['lon'];

		// print_r($post);
		
		if(empty($name)) {
			$errors['tname'] = "Name is a required field"; 
		} else if(!preg_match('/^.{1,50}$/', $name)) {
			$errors['tname'] = "Name is less than 50 characters"; 
		}
		if(empty($description)) {
			$errors['description'] = "Description is a required field"; 
		} else if(!preg_match('/^.{1,255}$/', $description)) {
			$errors['description'] = "Description is less than 256 characters"; 
		}
		if(empty($date)) {
			$errors['date'] = "Date is a required field"; 
		} else if(!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
			print "<p>". $date ."</p>";
			print strlen($date);
			$errors['date'] = "Date is formatted incorectly"; 
		}
		if(empty($rating)) {
			$errors['rating'] = "Rating is a required field"; 
		} else if(!preg_match('/^[1]?[0-9]{1,2}$/', $rating)) {
			$errors['rating'] = "Rating is a number 1 to 10"; 
		}
		if(empty($difficulty)) {
			$errors['difficulty'] = "Difficulty is a required field"; 
		} else if(!preg_match('/^[1]?[0-9]{1,2}$/', $difficulty)) {
			$errors['difficulty'] = "Difficulty is a number 1 to 10"; 
		}
		

		if($city != "") {
			if(!preg_match('/^[a-zA-Z ]{1,100}$/', $city)) {
				print "<p>". $city ."</p>";
				print strlen($city);
				$errors['city'] = 'City is not a valid value';
			}	
		}

		if($state != "") {
			if(!preg_match('/^[a-zA-Z ]{1,100}$/', $state)) {
				print "<p>". $state ."</p>";
				print strlen($state);
				$errors['state'] = 'State is not a valid value';
			}
		}

		if($lat != "") {
			if(!preg_match('/^[0-9.-]{0,30}$/', $lat)) {
				$errors['lat'] = 'Lattitude is not a valid value';
			}
		}


		if($lon != "") {
			if(!preg_match('/^[0-9.-]{0,30}$/', $lon)) {
				print($lon);
				$errors['lon'] = 'Longitude is not a valid value';
			}
		}

		
		if(!count($errors) == 0) {
			// Should pass out these errors better - use one of those functions you wrote
			print "<h1>There Are Errors In your form!!!</h1>";
			// print_r($errors);
			// Need to pass errors up here //
			
		} else {
			print "<h4>Form Success!!!</h4>";
			return $this->ts->newTrip($post);
			// print $tripBoolean;
		}	
	} 

	function getEntries() {
		return $this->ts->getEntries();
	}








	/**
	 * Checks all passed vars for empty and null
	 * Check passwords to match
	 */
	public function basicValidation($un, $em, $pw1, $pw2) {
		if ( $un != null && $pw1 != null && $em != null && $pw2 != null) {
			if ( trim($un) != "" && trim($pw1) != "" && trim($em) != "" && trim($pw2) != "") {
				if ( strlen($un) <= 45 && strlen($em) <= 60 && strlen($pw1) <= 45) {
					if ($pw1 == $pw2) {
						return true; // for too long args
					} else eCreate("Passwords do not match");
				} 
			} else eCreate("All fields are required");
		} else eCreate("All fields are required");
		return false;
	}

	/**
	 * Pass values through a regex check
	 */
	public function regexCheck($un, $em, $pw) {
		if(preg_match("/^[a-zA-Z0-9'-.@_]{4,}$/", $un)) {
			if (preg_match("/^[a-zA-Z0-9]{4,}$/", $pw)) {
				if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
					return true;
				} else eCreate("Please enter a valid Email address");
			} else eCreate("Invalid password");
		} else eCreate("Invalid username");
		return false;
	}

	/**
	 * Attempts to create a new user account in the DB
	 */
	public function createUserAccount($un, $em, $pw1, $pw2) {
		
		if($this->connect()) {
			if ($this->basicValidation($un, $em, $pw1, $pw2)) {
			 	if ($this->db->checkUserPresence($un)) {
					if ($this->regexCheck($un, $em, $pw1)) {
						$un = addslashes($un);
						$em = addslashes($em);
						$hashPasswd = password_hash($pw1, 1);

						if ($this->db->addNewUser($un, $em, $hashPasswd)) {
							sCreate("New user successfuly created");
							$this->db->disconnect();
							return true;
						} else eCreate("Error submitting info to DB");
					} 		
				} else eCreate("That Username is already taken");
			} 
		} else eCreate("Database Error");

		$this->db->disconnect();
		return false;
	} // createUserAccount

}
?>