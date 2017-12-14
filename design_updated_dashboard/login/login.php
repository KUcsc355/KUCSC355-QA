<?php
require_once 'dbconfig.php';

$blocked = False;//Not IP banned... yet

$result = $DB_con->prepare("DELETE FROM `locked` WHERE `timestamp` < (now()- interval 5 minute)");
$result->execute();

$ip = $_SERVER["REMOTE_ADDR"];

$result = $DB_con->prepare("SELECT COUNT(*) FROM `locked` WHERE `address` LIKE :ip AND `timestamp` > (now() - interval 10 minute)");
$result->execute(array(":ip"=>$ip));
$count=$result->fetch(PDO::FETCH_NUM);

//Count amount of attempts performed by user, block them if they
//  try too many times
if($count[0] > 3){
    $error = "You are allowed 3 attempts in 10 minutes";
    $blocked = True;
}

//Check for 10 minutes to have passed

if($user->is_loggedin()!="")
{
    $user->redirect('signed_in.php');
}

//Once the login button has been pressed
if(isset($_POST['Submit']))
{

    //Grab the user's inputted data
    $umail = $_POST['myemail']; //One size fits all
    $upass = $_POST['mypassword'];

    //aaand log 'em in
    if($user->login($umail,$upass))
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
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>
  
  <body>
    <div class="container">
      <form class="form-signin" name="form1" method="post" action="#"> <!-- action determines where the form is sent -->
        <img src="images/aitp_logo.png" alt="LV-AITP Logo">
        <br><br>
        <h2 class="form-signin-heading">LV-AITP Login</h2>
        <?php
            if(isset($error))
            {
                echo $error;
            }
        ?>
        <input name="myemail" id="myemail" type="text" class="form-control" placeholder="Email" autofocus>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">

        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <!--<a href="signup.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Create new account</a><br>-->
      <p align="center"><label><a href = "forgot_password.php">Forgot Password?</a></label></p>
      <p align="center"><label>Don't have an account yet? <a href="signup.php">Sign up</a></label></p>

      <br><br><br><br><br><br><br><br><br> <!-- push to bottom for testing PLEASE REMOVE WHEN YOU'RE DONE -->

      <a href="signed_in.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Signed in (test)</a>
        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>

  </body>
</html>
