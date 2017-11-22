
<?php
include('includes/head.php');
include('includes/header.php');

$userService = new UserService(newClient());

$uname= $email= $password= $repassword= $successMessage= "";
$errors = [];


if(isset($_POST['post_new_user'])) {

	if(!empty(trim($_POST['uname']))) { // has content when trimmed // validate for characters and length
		$uname = trim($_POST['uname']);
		if(!preg_match('/^[\w]{1,50}$/', $uname)) {
			$errors['uname'] = "Incorrect Username Format";
		} 
	} else {
		$errors['uname'] = "Incorrect Username Format";
	}

	$email = trim($_POST['email']);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 		 $errors['email'] = "Invalid email format"; 
	}


	if(empty($_POST['password'])) {
		$errors['password'] = "Passowrd Required";
	} else {
		$password = trim($_POST['password']);
		if(!preg_match('/^[a-zA-Z0-9]{5,50}$/', $password)) {
			$errors['password'] = "Passwords must be 5 to 50 chars, and consist of letters and numbers only.";
		}
	}

	$repassword = $_POST['repassword'];
	if($password != $repassword) {
		$errors['repassword'] = "Passwords must match";		
	}

	if(count($errors) == 0) {
		// submit to API here //
		if(!$userService->newUser($uname, $email, $password)) {
			$successMessage = "Unable to create a new user";
		} else {
			header("Location: allusers.php");
		}
	}

	
}


?>
<div class="col-sm-12" style="background: #ccc;">
	<div class="col-sm-6"></div>
	<div class="col-sm-6">
		<form method="post" action="#">
			<h2>Add a new User</h2>
			<div class="form-group">
				<label>Username</label>
				<input class="form-control" type="text" name="uname" value="<?php print isset($_POST['uname']) ? $_POST['uname'] : ""  ?>">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input class="form-control" type="email" name="email" value="<?php print isset($_POST['email']) ? $_POST['email'] : ""  ?>">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input class="form-control" type="password" name="password">
			</div>
			<div class="form-group">
				<label>Re-enter Password</label>
				<input class="form-control" type="password" name="repassword">
			</div>
			<button class="btn btn-sm btn-success" type="submit" name="post_new_user">Submit User</button>
		</form>

		<?php print isset($errors) ? "<small class='text-danger'>". reset($errors). "</small>" : "" ?>
		<?php print isset($successMessage) ? $successMessage : "" ?>
	</div>	
</div>


<?php
include('includes/footer.php');
?>