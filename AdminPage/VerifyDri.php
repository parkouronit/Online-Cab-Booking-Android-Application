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
    if(isset($_POST['verify'])){
        if(empty($_POST['id'])){
            echo "<script type='text/javascript'>alert('driver id missing');</script>";
        }else{
            $id=$_POST['id'];
             $users->ver($id);
        }
    }

?>
<html>
<head>
  <title>Admin</title>

  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <form action="VerifyDri.php" method="POST">
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
	    <h4 class="title">Drivers Table</h4>

    </div>

     <div class="card-content">
 	    <input type="text" name="id" placeholder="Enter the driver's id to verify.">
       <input type="submit" value="Verify Driver" name="verify">
 	  </div>
      <div class="card-content table-responsive">
        <table>
          <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>Email</th>
			<th>Contact</th>
          </tr>
            <?php
            $con=mysqli_connect("localhost","id4173357_root","","id4173357_localhost");
            if(isset($_POST['veri'])){
          		    $query=mysqli_query($con,"select * from driver where verified=1");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['driver_id'];
          					$name=$row['name'];
          					$email=$row['email'];
          					$contact=$row['contact'];
          					echo "<tr><td>$id</td>";
          					echo "<td>$name</td>";
          					echo "<td>$email</td>";
          					echo "<td>$contact</td>";
          			}
          			echo "</tr>";
            }elseif(isset($_POST['nonveri'])){
                $query=mysqli_query($con,"select * from driver where verified=0");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['driver_id'];
          					$name=$row['name'];
          					$email=$row['email'];
          					$contact=$row['contact'];
          					echo "<tr><td>$id</td>";
          					echo "<td>$name</td>";
          					echo "<td>$email</td>";
          					echo "<td>$contact</td>";
          				}
          			echo "</tr>";
            }elseif(isset($_POST['ontri'])){
                $query=mysqli_query($con,"select * from driver where ontrip=1");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['driver_id'];
          					$name=$row['name'];
          					$email=$row['email'];
          					$contact=$row['contact'];
          					echo "<tr><td>$id</td>";
          					echo "<td>$name</td>";
          					echo "<td>$email</td>";
          					echo "<td>$contact</td>";
          				}
          			echo "</tr>";
            }elseif(isset($_POST['nontri'])){
                $query=mysqli_query($con,"select * from driver where ontrip=0");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['driver_id'];
          					$name=$row['name'];
          					$email=$row['email'];
          					$contact=$row['contact'];
          					echo "<tr><td>$id</td>";
          					echo "<td>$name</td>";
          					echo "<td>$email</td>";
          					echo "<td>$contact</td>";
          				}
          			echo "</tr>";
            }else{
                $query=mysqli_query($con,"select * from driver");
          				while($row = mysqli_fetch_array($query)) {
          					$id=$row['driver_id'];
          					$name=$row['name'];
          					$email=$row['email'];
          					$contact=$row['contact'];
          					echo "<tr><td>$id</td>";
          					echo "<td>$name</td>";
          					echo "<td>$email</td>";
          					echo "<td>$contact</td>";
          				}
          			echo "</tr>";
            }

            ?>
            <tr>
                <td><input type="submit" value="Verified Driver" name="veri"></td>
                <td><input type="submit" value="Non Verified Driver" name="nonveri"></td>
                <td><input type="submit" value="Drivers on trip" name="ontri"></td>
                <td><input type="submit" value="Drivers not on trip" name="nontri"></td>
            </tr>
		  </table>
      </div>
  </div>
</div>
</div>
</form>
</body>
</html>
