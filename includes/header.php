<?php 
// get list of current owners from trips with owners

require('includes/guzzle.php');
require('helpers.php');
require('Services/UserService.php');
require("Services/ActivityService.php");
require("Services/TripService.php");
require('controllers/Control.php');
require("controllers/TripController.php");
require('controllers/LoginController.php');

$us = new UserService(newClient());
$owners = $us->getUsersNames();
// $owners = ["Pierce", "Sam", "Drew"];
session_start();
if(isset($_POST['submit_owner'])) {
  if($_POST['owner'] != "") {
    $_SESSION['owner'] = $_POST['owner'];  
    // print "<p>you chose ".$_SESSION['owner']."</p>";
  }
  
}

?>

<header>
  <nav class="navbar navbar-expand-sm bg-dark navbar-light">
    <ul class="navbar-nav">
      <!-- Brand -->
      <a class="navbar-brand" href="index.php">Daytripper.Php</a>
      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Users
        </a>
        <div class="dropdown-menu">
          <!-- <a class="nav-link" href="index.php">Home</a> -->
          <a class="nav-link" href="allusers.php">Users</a>
          <a class="nav-link" href="newuser.php">New User</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Trips
        </a>
        <div class="dropdown-menu">
          <!-- <a class="nav-link" href="index.php">Home</a> -->
          <a class="nav-link" href="trips.php">Trips</a>
          <a class="nav-link" href="new_entry.php">New Trip</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-sm-auto ">
        <li>
          <span class="navbar-text mr-sm-3 text-success">
            <?php print isset($_SESSION['owner']) ? "Welcome " . $_SESSION['owner'] : "" ?>
          </span>
        </li>
        <li>
          <form method="post" action="#" class="form-inline">
            <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search"> -->
            
            <select class="form-control mr-sm-3" name="owner">
              <option value="">Choose Owner</option>
              <?php foreach ($owners as $key => $value): ?>
                <option value="<?php print $value ?>"><?php print $value ?></option>
              <?php endforeach ?>
            </select>
            <button class="btn btn-success" type="submit" name="submit_owner">Auth</button>
          </form>  
        </li>
        

    </ul>
  </nav>


  
  




</header>
