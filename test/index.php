<!-- Index page containing log in -->

<?php require "login/loginheader.php"; ?> <!-- DO NOT REMOVE THIS LINE OF CODE EVER -->

<?php
//This header should be included on top of every page;
//  it grabs user data from either the database or
//  their session variable
include_once 'login/dbconfig.php';


if(isset($_POST['Submit'])) 
{

    //Grab the user's inputted data
    $uname = $_POST['myusername']; //One size fits all 
    $upass = $_POST['mypassword']; //ALSO CHANGE THESE TO WHATEVER YOU NAMED THOSE FORM FIELDS

    //aaand log 'em in
    if($user->login($uname,$upass))
    {
        //if successful log in, delete all records of shifty activity from the IP address
        //  so you don't get immediately blocked next time you forget your password.
        $result = $DB_con->prepare("DELETE FROM `locked` WHERE `address` LIKE :ip");
        $result->execute(array(":ip"=>$ip));

        //Ok I promised an explanation so here it is:
        //  When you sign up for the site, the min password length
        //  (enforced by the site) is 6 characters.  By forcing the
        //  temp password in the forgot password section to be an
        //  impossible length of 5 characters, I can perform a simple
        //  check to see whether the password is the temporarily-
        //  assigned one or not.  Hacky code at its best and brightest;
        //  Nyce job, Brendon!
        if(strlen($upass) == 5){
            //Once it is detected that you logged in with a temp password,
            //  immediately send user to the change password station.
            $user->redirect('change_password.php');
        }
        else{$user->redirect('signed_in.php');}
    }
    else
    {
        $error = "Invalid credentials, try again.";
        if($count[0]>=1)//If user forgets password too frequently in a row,
            $error .= "<br><a href=\"forgot_password.php\"><i>(Forgot Password?)</i></a>"; //  offer a nice egg in this trying time.
        //Regardless of reason, store person's IP into database to be able to block them in case they're a master hacker who hang glides
        $stmt = $DB_con->prepare("INSERT INTO `locked` (`address` ,`timestamp`)VALUES (:ip,CURRENT_TIMESTAMP)");
        $stmt->execute(array(":ip"=>$ip));

    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AITP Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
  </head>
  
  <body>
    <div class="container">

        <!-- ACTION REDIRECTS THE PAGE TO THE SIGNED_IN PAGE -->
        <form class="form-signin" name="form1" method="post" action="login/signed_in.php">

            <!-- IMAGE AT TOP OF PAGE -->
            <img src="login/images/aitp_logo.png" alt="LV-AITP Logo">
            <br><br> <!--adds a little space between logo and text boxes -->

            <!-- TEXT ABOVE FIELD BOXES -->
            <h2 class="form-signin-heading">LV-AITP Login</h2>

            <!--EMAIL AND PASSWORD TEXT FIELDS -->
            <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Email" autofocus>
            <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">

            <!-- THE SIGN IN BUTTON -->
            <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

            <!-- LINKS UNDER THE SIGN IN BUTTON -->
            <p align="center"><label><a href = "login/forgot_password.php">Forgot Password?</a></label></p>
            <p align="center"><label>Don't have an account yet? <a href="login/signup.php">Sign up</a></label></p>

            <!-- FOR BOTTOM TESTING BUTTON -->
            <br><br><br><br><br><br><br><br><br> <!-- push to bottom for testing PLEASE REMOVE WHEN YOU'RE DONE -->

            <a href="login/signed_in.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Signed in (test)</a>
        
            <!--                             -->

        <!-- REMAINDER SECTION -->
        <div id="message"></div> <!-- /div -->
      </form> <!-- /form -->
    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>

  </body>
</html>

