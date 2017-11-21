<?php 
// get list of current owners from trips with owners
$owners = 

if(isset($_POST['submit_owner'])) {

}


 ?>

<header>
  <nav class="navbar navbar-expand-sm bg-dark navbar-light">
    <ul class="navbar-nav">
      <!-- Brand -->
      <a class="navbar-brand" href="index.php">Daytripper.Php</a>
      <!-- <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="allusers.php">Users</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="newuser.php">New User</a>
      </li> -->



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
    <ul class="navbar-nav ml-auto">
        <li>
          <form class="form-inline">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-success" type="submit_owner">Choose Owner</button>
            <select>
              <option value="Anyone">Choose Owner</option>
              <?php foreach ($owners as $key => $value): ?>
                <option value="<?php print $value ?>"><?php print $value ?></option>
              <?php endforeach ?>
            </select>
          </form>  
        </li>
        

    </ul>
  </nav>


  
  




</header>
