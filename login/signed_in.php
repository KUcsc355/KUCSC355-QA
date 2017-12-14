<!-- This page displays buttons on the main login screen -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AITP Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="../css/dashboard_conf/dash_boot/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

    <!-- Sidebar CSS -->
    <link href="../css/dashboard_conf/dashboard_css/sidebar.css" rel="stylesheet" media="screen"> <!--media=screen for computer screens,tablets,smartphones-->
  </head>

  <body>
    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
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
				<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> <!-- don't do this, used for testing purposes-->
                <a href='logout.php?logout=true\'>logout</a></h3>
				<li>
                    <a href="http://www.aitptest.weebly.com">Back to LV-AITP.org</a>
				</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Open Dashboard</a><br><br>
                <!--<img src="images/aitp_logo.png" alt="LV-AITP Logo"><br><br>--> <!-- THIS AITP IMAGE SHOULD BE ADDED SOMEWHERE ON THIS PAGE -->
                <h1><u>Account Summary<u></h1><br><br>
                <h4>Name: </h4><br>
                <h4>Email: </h4><br>
                <h4>Current Address: </h4><br>
                <h4>Membership Type: </h4><br>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="../css/dashboard_conf/dash_boot/jquery/jquery.min.js"></script>
    <script src="../css/dashboard_conf/dash_boot/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

  </body>
</html>
