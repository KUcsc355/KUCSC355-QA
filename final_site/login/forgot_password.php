<p><label><a href = "../index.php">go back to login page</a></label></p>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../assets/css/logincss/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../assets/css/logincss/main.css" rel="stylesheet" media="screen">
  </head>
  
  <body>
    <div class="container">

        <!-- ACTION REDIRECTS THE PAGE TO THE SIGNED_IN PAGE -->
        <form class="form-signin" name="form1" method="post" action="#">

            <!-- IMAGE AT TOP OF PAGE -->
            <img src="../assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo">
            <br><br> <!--adds a little space between logo and text boxes -->

            <!-- TEXT ABOVE FIELD BOXES -->
            <h2 class="form-signin-heading">Change Password</h2>

            <!--EMAIL AND PASSWORD TEXT FIELDS -->
            <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Email" autofocus><br>
            

            <!-- THE SIGN IN BUTTON -->
            <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Send Password Link</button>

        <!-- REMAINDER SECTION -->
        <div id="message"></div> <!-- /div -->
      </form> <!-- /form -->
    </div> <!-- /container -->
  </body>
</html>
