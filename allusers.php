
<?php
include('includes/head.php');
include('includes/header.php');

include("Services/UserService.php");
include("helpers.php");
require('includes/guzzle.php');

$userService = new UserService(newClient());
$users = $userService->getUsers();
$userByUname = null;
$userToEdit = null;
$updateMessage = "";


if(isset($_POST['user_edit'])) {
	$uname = $email = $_id = "";
	$errors = [];
	$_id = "";
	if(empty($_POST['uname'])) {
		$errors['uname'] = "Username cannot be blank";
	} else {
		$uname = $_POST['uname'];
	}

	if(empty($_POST['email'])) {
		$errors['email'] = "email cannot be blank";
	} else {
		$email = $_POST['email'];
	}	

	if(empty($_POST['_id'])) {
		// print "<p>id is empty</p>";
		$errors['_id'] = "_id cannot be blank";
	} else {
		// print "<p>id is NOT empty</p>";
		$_id = $_POST['_id'];
	}

	if(count($errors) == 0) {
		$resp = $userService->updateUser(['uname' => $uname, 'email' => $email, '_id' => $_id]);
		if($resp) {
			$updateMessage = "<p class='text-success'>User updated!</p>";
			// header("Location: allusers.php");
		}
		else {
			$updateMessage = "<p>User not updated!</p>";	
		}
	}
}

if(isset($_POST['user_by_uname'])) {
	if(isset($_POST['uname'])) {
		$userByUname = $userService->getUserByUname($_POST['uname']);
	}
} 

if(isset($_POST['delete_user'])) {
	$arr = ["one", "two", "three"];

	if(!empty($_POST['user_id'])) {
		// print_r("Post is set");
		$userService->deleteUser($_POST['user_id']);
	}
	else {
		// print_r("Post is NOT set");
	}
} 



if(isset($_POST['edit_user']) && !empty($_POST['_id'])) {
	$_id = $_POST['_id'];
	// get the user from api
	// display a form to edit
	// write contents back to api
	// redirect
	
	$u = $userService->getUser($_id);
	if($u) {
		// Probably should check if($u)
	}

?>
<div class="container-fluid">
	<!-- Edit user form -->
	<h4>Edit User</h4>
	<form method="post" action="#">
		<div class="form-group">
			<label for="uname">Username:</label>
			<input class="form-control" id="uname" type="text" name="uname" value="<?php echo $u->uname ?>">	
		</div>
		<p class="form-group">
			<label for="email">Email:</label>
			<input class="form-control" id="email" type="email" name="email" value="<?php echo $u->email ?>">	
		</p>
		<input type="hidden" name="_id" value="<?php echo $u->_id ?>">
		<p>
			<input class="btn btn-sm" type="submit" name="user_edit">	
		</p>
	</form>
	<form method="post" action="#">
		<input type="hidden" name="user_id" value="<?php echo $u->_id ?>">
		<input class='btn btn-sm btn-danger' type="submit" name="delete_user" value="Delete">
	</form>
	<?php print isset($errors) ? reset($errors) : "" ?>
</div>
<?php	
} 

else { // has not clicked edit a user

?>
<div class="container-fluid">
<?php
	print $updateMessage;
?>
<h3>All Users</h3>
<?php
	printUsers($userService->getUsers());
?>
</div>

<div class="container-fluid">
	<form action="#" method="post">
		<h3>Get a User by UserName</h3>
		<div class="form-group">
			<select class="form-control" name="uname">
			<?php
			if(isset($users)) {
				foreach ($users as $key => $value) {
					print "<option value='" . $value->uname . "'>" . $value->uname . "</option>";
				}
			}
			
			?>	
			</select>
		</div>	
		<button class="btn btn-sm" type="submit" name="user_by_uname">Get a User</button>
	</form>
	<div >
		<?php
		// print_r($userByUname);
		if(isset($userByUname)) {
			printUsers([$userByUname], "");
		}
		?>
	</div>
</div>

<?php
}
?>




<?php
include('includes/footer.php');
?>