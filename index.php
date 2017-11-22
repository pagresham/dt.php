<?php

// VHosts issues, couldn't get hosts to work on the Mac, but Windows worked fine.  
// Permissions - when I switched machines
// Turn on error reporting - How did i fix the error issues? - found error in php.ini file, that stopped logging from happening. 
// 
// I need to prioritize what I want to do with this app. 

// Incorporate a Map!
// Photo Upload?

// Bugs on Mac - 
// 1. non unique values in trip search filter
// 2. value taken from - answer: If the text field is filled out, that takes precedence
// - maybe disable the other if one has a value in it. Woo Hoooo JavaScript


// Can do if trip belongs to you...
// update Trip
// Delete Trip

// Example of setting the status or a response manually: 
// res.status(500).json({ error: 'something is wrong' });

include('includes/head.php');
include('includes/header.php');


/*
This is a test application to experiment with different ways of calling the API
Located at http://localhost:3000/
This is a node.js application sitting at: /Users/piercegresham/Google Drive/javaScriptSandbox/node_tutorials_copy/DayTripper
 */


$userService = new UserService(newClient());


$userArray = null;
$activityArray = null;



$users = [];
$users = $userService->getUsers();
$user = null;
// $userPostUrl = "http://localhost:3000/user/new";
$userPostUrl = "";
$response = null;
$body = null;
$allUserArr = [];
$newUserMessage = "";

if(isset($_POST['users'])) {
	$userArray = $userService->getUsers();

} else if (isset($_POST['activitys'])) {
	$activityArray = $userService->getActivities();

} else if (isset($_POST['submit_user'])) {
	if(!empty($_POST['select_user'])) {
		$user = $userService->getUser($_POST['select_user']);
	} 

} else if (isset($_GET['get_user'])) {
	if(!empty($_GET['_id'])) {
		// $user = $api->getUser($_GET['select_user']);
		$user = json_decode(file_get_contents('http://localhost:3000/user/id/' . $_GET['_id']));

	}

} else if(isset($_GET['new_user_submit'])) { // get all users
	$response = $client->get("http://localhost:3000/user");
	
	if($response->getStatusCode() == 200 && $response->getReasonPhrase() == "OK") {
		
		$body = $response->getBody();
		$allUserArr = json_decode($body);
	}
	
	// header("Location: index.php");
} else if(isset($_POST['post_new_user'])) { // post a new user
	// do validation and sterilization
	$uname = $_POST['uname']; // need to check DB to see if uname is already in use. 
	$email = $_POST['email']; // validate email
	$password = $_POST['password']; // would also need to check if pass1 and pass2 match


	$response = $userService->newUser($uname, $email, $password);
	
	if($response) {
		$newUserMessage = "Successful Response!";
	} else {
		$newUserMessage = "There was a problem!";
	}
}



?>
<div class="container">
		
	<div >
		<div class="text-left" style="background: #ccc; border: 1px solid #777; margin:1em;border-radius: 5px;padding:.5em;">
			<h4>What?</h4>
			<p>This is a proof of concept app. It's intent is to test the Daytripper API in a simple PHP application.</p>
		</div>
		
		<div class="col-md-12 row" >
			<div class="col md-4 small"></div>
			<div class="col md-4"></div>
			<div class="col md-4"></div>
		</div>
	</div>

</div>





<!-- <div>
	
	<form action="#" method="post">
		<button type="submit" name="users">Get Users with a simple form</button>
	</form>
	<form action="#" method="post">
		<button type="submit" name="activitys">Get Activities with a simple form</button>
	</form>
</div> -->



<!-- <div style="border: 1px solid black;">
	<form action="#" method="get">
		<h2>Get a User by ID</h2>
		<select name="_id">
		<?php
		foreach ($users as $key => $value) {
			print "<option value='" . $value->_id . "'>" . $value->uname . "</option>";
		}
		?>	
		</select>
		<button type="submit" name="get_user">Get a User</button>
	</form>

</div>

<div style="border:1px solid black;">
	<form method="get" action="<?php echo $userPostUrl; ?>">
		<h2>Get All Users</h2>
		<p>Here I am using a form submit button with a method='get'</p>
		<p>Then use Guzzle's Client->get(url) method.</p>
		<input type="submit" name="new_user_submit" value="GetAllUsers">
	</form>
	<div>
		<?php
			if(isset($allUserArr)) {
				foreach ($allUserArr as $key => $value) {
					print "<br>";
					print "<br>";
					print $allUserArr[$key]->_id . "<br>";
					print $allUserArr[$key]->uname . "<br>";
					print $allUserArr[$key]->password . "<br>";
					print $allUserArr[$key]->email . "<br>";
				}
			}
		?>
	</div>
</div>
<div style="border:1px solid black;">
	<form method="post" action="#">
		<h2>Add a new User</h2>
		<p>Use standard form to pass post array params to Guzzle Client->request() method.</p>
		<p>Make sure to use ['json'=> [ < body elements > ]]</p>
		<p>
			<label>Username</label>
			<input type="text" name="uname">
		</p>
		<p>
			<label>Email</label>
			<input type="email" name="email">
		</p>
		<p>
			<label>Password</label>
			<input type="password" name="password">
		</p>
		<button type="submit" name="post_new_user">Submit User</button>
	</form>
	<?php print isset($newUserMessage) ? $newUserMessage : "" ?>
</div>



<div>
	<?php
	if($userArray) {
		printUsers($userArray);
	} else if ($activityArray) {
		printActivities($activityArray);
	} else if ($user) {
		printUser($user);
		// print_r($user);
	}
	?>
</div> -->

<?php
include "includes/footer.php";
?>


