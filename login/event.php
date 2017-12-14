<!-- This page displays input fields to create an event -->
<?php

require_once 'dbconfig.php';	
include '../event/clsEvents.php';

/*$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);*/

if(isset($_POST['addEvent']))
{
	$eventName = trim($_POST['eventName']);
	$speaker = trim($_POST['speaker']);
	$address = trim($_POST['address']);
	$date = trim($_POST['date']);
	$time = trim($_POST['time']);
	$fee = trim($_POST['fee']);
	$description = trim($_POST['description']);
//	$attendees = trim($_POST['attendees']);
	
	$eventobject = new Events();
	echo " event object $eventObject";
	$eventobject->createEvent($eventName, $speaker, $address, $date, $time, $fee, $description);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Event Creation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <!-- <link href="../css/bootstrap.css" rel="stylesheet" media="screen"> -->
    <!--<link href="../css/main.css" rel="stylesheet" media="screen"> -->
	
	<!-- Bootstrap -->
    <link href="../css/dashboard_conf/dash_boot/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	
	<!-- CSS for Sidebar -->
    <link href="../css/dashboard_conf/dashboard_css/sidebar.css" rel="stylesheet" media="screen"> <!--media=screen for computer screens,tablets,smartphones-->
  </head>

  <body>
  <!-- Dashboard Content -->
  <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="signed_in.php">
                        AITP Dashboard
                    </a>
                </li>
                <li>
                    <a href="signed_in.php">Account Summary</a>
                </li>
                <li>
                    <a href="event.php">Create Events</a>
                </li>
                <li>
                    <a href="mail.php">Send Email</a>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->    
  
  <!-- Page Content -->
  <div class="container">
  <div class="container-fluid">
    <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Open Dashboard</a><br><br>
  </div>
      <form class="form-signin" name="form1" method="post" action="#"> <!-- action needs to redirect to where the form is submitted -->
        <h2 class="form-signin-heading">Create Event</h2>
        <label>Event Name</label><input name="eventName" id="eventName" type="text" class="form-control" autofocus> <br>
        <label>Speaker(s)</label><input name="speaker" id="speaker" type="text" class="form-control"><br>
		<label>Address</label><input name="address" id="address" type="text" class="form-control"><br>
		<label>Date</label><input name="date" id="date" type="text" class="form-control"><br>
		<label>Fee</label><input name="fee" id="fee" type="text" class="form-control"><br>
		<label>Description</label><input name="description" id="description" type="text" class="form-control"><br>
        
        <button name="addEvent" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Add Event</button>
      <br><br>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

	<!-- Bootstrap core JavaScript -->
	<!-- Necessary for making the dashboard toggle -->
    <script src="../css/dashboard_conf/dash_boot/jquery/jquery.min.js"></script>
    <script src="../css/dashboard_conf/dash_boot/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>

  </body>
</html>
