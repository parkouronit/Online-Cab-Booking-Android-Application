<?php
  session_start();
  require_once 'include/DB_Functions.php';
  $users=new DB_Functions();
  if (!$users->isUserLoggedIn() == true) {
  		header("Location:index.php");
  		exit();
  	}
    if(isset($_POST['logout'])){

    	$user->doLogout();
    }
?>
<html>
<head>
  <title>Admin</title>

  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div id="header">
  <div class="logo">
  <a href="#">Ad<span>Min</span></a>
</div>
</div>


<div id="container">
  <div class="sidebar">
    <ul id="nav">
      <li><a href="#">User : <?php echo $_SESSION['a_name']; ?> </a></li>
      <li><a href="dashboard.php">Users Details</a></li>
      <li><a href="VerifyDri.php">Verify Drivers</a></li>
      <li><a href="Booking.php">Bookings</a></li>
      <li><a href="Cabs.php">Add Cabs</a></li>
      <li><a href="Driverfeedback.php">Users' Feedback</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>

  <div class="content">
    <div class="card">
    <div class="card-header">
	    <h4 class="title">Users Table</h4>
	   </div>
      <div class="card-content table-responsive">
        <table>
          <tr>
            <th>ID</th>
            <th>Driver Email</th>
            <th>User Email</th>
			<th>Ratings</th>
          </tr>
          <?php
                      $con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");
          		    $query=mysqli_query($con,"select * from feeback");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['r_id'];
          					$driver=$row['driver_email'];
          					$user=$row['user_email'];
          					$points=$row['f_ponits'];
          					echo "<tr><td>$id</td>";
          					echo "<td>$driver</td>";
          					echo "<td>$user</td>";
          					echo "<td>$points</td>";
          			}
          			echo "</tr>"


            ?>
		  </table>
      </div>
  </div>
</div>
</div>

</body>
</html>
