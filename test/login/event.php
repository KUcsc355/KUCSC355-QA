<!-- This page displays input fields to create an event -->
<!-- The created event then gets submitted to the event DB -->

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

  <!-- DASHBOARD CONTENT -->
  <!-- copy and paste to other dashboard pages as needed -->
  <div id="wrapper">

    <!-- SIDEBAR CONTENT -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <!-- IMAGE DISPLAYED AT TOP OF DASHBOARD SIDEBAR -->
        <img src="images/aitp_logo.png" alt="LV-AITP Logo"><br><br>
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
        </li>
        <li>
          <a href="../index.php">Logout (Test)</a>
        </li>
      </ul>

    </div> <!-- /#sidebar-wrapper -->  

    <!-- PAGE CONTENT -->
    <div class="container">

      <!-- OPEN DASHBOARD BUTTON -->
      <!-- copy and paste to other dashboard pages as needed -->
      <div class="container-fluid">

        <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Open Dashboard</a><br><br>

      </div> <!-- /container-fluid -->
      
      <!-- ACTION REDIRECTS THE PAGE TO ___ PAGE -->
      <form class="form-signin" name="form1" method="post" action="#">

        <!-- TEXT ABOVE FIELD BOXES -->
        <h2 class="form-signin-heading">Create Event</h2>

        <!-- TEXT FIELDS -->
        <label>Event Name</label><input name="eventName" id="eventName" type="text" class="form-control" autofocus> <br>

        <label>Speaker(s)</label><input name="speaker" id="speaker" type="text" class="form-control"><br>

        <label>Address</label><input name="address" id="address" type="text" class="form-control"><br>

        <label>Date</label><input name="date" id="date" type="text" class="form-control"><br>

        <label>Fee</label><input name="fee" id="fee" type="text" class="form-control"><br>

        <label>Description</label><input name="description" id="description" type="text" class="form-control"><br>
        
        <!-- THE ADD EVENT BUTTON -->
        <button name="addEvent" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Add Event</button>
        <br><br>

        <!-- REAMINDER SECTION -->
        <div id="message"></div> <!-- /div-message -->
      </form> <!-- /form -->
    </div> <!-- /container -->

    <!-- BOOTSTRAP CORE JAVASCRIPT -->
    <!-- NECESSARY FOR MAKING THE DASHBOARD TOGGLE -->
    <script src="../css/dashboard_conf/dash_boot/jquery/jquery.min.js"></script>
    <script src="../css/dashboard_conf/dash_boot/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT THAT TOGGLES THE SLIDING DASHBOARD -->
    <!-- copy and paste to other dashboard pages as needed -->
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
