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

  <!--  -->
  <form id="form-email" class="form-email" name="email_form" method="post" action="mail_submit.php" >

    <!-- TEXT ABOVE FIELD BOXES -->
    <h2 class="form-signin-heading">Email</h2>

    <!-- TEXT FIELDS -->
    <label>Subject:</label><input name="subject" id="subject" type="text" class="form-control"><br>
    <label>Content:</label><input name="content" id="content" type="text" class="form-control" placeholder="Content goes here"><br>

    <!-- THE SEND BUTTON-->
    <button name="sendmessage" id="sendmessage" class="btn btn-lg btn-primary btn-block" style="cursor:pointer" type="submit">Send</button>
    <br><br>

    <!-- SEND MAIL TEST DEMO -->
    <!-- remove when working properly -->
    <p id="demo">Click the button to make sure the function is called.</p>

    <!-- REMAINDER SECTION -->
    <div id="message"></div> <!-- /div-message -->
</form> <!-- /form -->
</div> <!-- /container -->

<!-- Bootstrap core JavaScript -->
<!-- Necessary for making the dashboard toggle -->
<script src="../css/dashboard_conf/dash_boot/jquery/jquery.min.js"></script>
<script src="../css/dashboard_conf/dash_boot/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- SCRIPT THAT TOGGLES THE SLIDING DASHBOARD -->
<!-- copy and paste to other dashboard pages as needed -->
<script>
  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });

  // $("#form-email").submit(function(){

  //   var str = $(this).serialize();
  //   $.ajax('mail_submit.php', str, function(result){

  //     alert(result);
  //   }
  //   return(false);
  // });

  // }




</script>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-2.2.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<!-- The AJAX login script -->
<script src="js/login.js"></script>

</body>
</html>