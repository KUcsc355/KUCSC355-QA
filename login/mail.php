<!-- This page displays buttons on the main login screen -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mail Blasts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <!-- <link href="../css/bootstrap.css" rel="stylesheet" media="screen"> -->
    <!--<link href="../css/main.css" rel="stylesheet" media="screen"> -->
    <link href="../css/dashboard_conf/dash_boot/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
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
      <form class="form-email" name="email_form" method="post" action="mail_submit.php">
       <!-- action needs to redirect to where the form is submitted -->
        <h2 class="form-signin-heading">Email</h2>
        <label>Subject:</label><input name="subject" id="subject" type="text" class="form-control"><br>
		<label>Content:</label><input name="content" id="content" type="text" class="form-control" placeholder="Content goes here"><br>
        <button name="sendmessage" id="sendmessage" class="btn btn-lg btn-primary btn-block" type="submit">Send</button>
      <br><br>
      
<script>
    function sendmessage() {
      var email_form = {
        subject: email_form.subject.value,
        content: email_form.content.value,
        data: JSON.stringify(email_form),
        //POST: "http://ec2-18-221-141-67.us-east-2.compute.amazonaws.com/announcement/blast",
        POST:"http://ec2-18-216-109-127.us-east-2.compute.amazonaws.com/"
      };
</script>


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
