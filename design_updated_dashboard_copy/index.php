<!-- Index page containing log in -->

<?php require "login/loginheader.php";  //<!-- DO NOT REMOVE THIS LINE OF CODE EVER -->

$blocked = False;//Not IP banned... yet

$result = $DB_con->prepare("DELETE FROM `locked` WHERE `timestamp` < (now()- interval 10 minute)");
$result->execute();

function getClientIP(){       
     if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
            return  $_SERVER["HTTP_X_FORWARDED_FOR"];  
     }else if (array_key_exists('REMOTE_ADDR', $_SERVER)) { 
            return $_SERVER["REMOTE_ADDR"]; 
     }else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
            return $_SERVER["HTTP_CLIENT_IP"]; 
     } 

     return '';
}
$ip=getClientIP();

$result = $DB_con->prepare("SELECT COUNT(*) FROM `locked` WHERE `address` LIKE :ip AND `timestamp` > (now() - interval 10 minute)");
$result->execute(array(":ip"=>$ip));
$count=$result->fetch(PDO::FETCH_NUM);


//This header should be included on top of every page;
//  it grabs user data from either the database or
//  their session variable
//include_once 'login/dbconfig.php';

if($user->is_loggedin()!="")
{
    $user->redirect('login/user.php');
}


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
            $user->redirect('login/change_password.php');
        }
        else{$user->redirect('login/user.php');}
    }
    else
    {
        $error = "Invalid credentials, try again.";
        if($count[0]>=1)//If user forgets password too frequently in a row,
            $error .= "<br><a href=\"login/forgot_password.php\"><i>(Forgot Password?)</i></a>"; //  offer a nice egg in this trying time.
        //Regardless of reason, store person's IP into database to be able to block them in case they're a master hacker who hang glides
        $stmt = $DB_con->prepare("INSERT INTO `locked` (`address` ,`timestamp`)VALUES (:ip,CURRENT_TIMESTAMP)");
        $stmt->execute(array(":ip"=>$ip));

    }
}

if($count[0] > 3){
    $error = "You are allowed 5 attempts in 10 minutes";
    $blocked = True;
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>AITP Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="assets/css/logincss/bootstrap.css" rel="stylesheet" media="screen">
    <link href="assets/css/logincss/main.css" rel="stylesheet" media="screen">

    <!----THESE 4 ARE MAKING THE CURRENT THEME ---->
            <!-- Bootstrap core CSS    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <!----THESE 4 ARE MAKING THE CURRENT THEME ---->

  </head>
  
  <body>
    <div class="container">

        <!-- ACTION REDIRECTS THE PAGE TO THE SIGNED_IN PAGE -->
        <form class="form-signin" name="form1" method="post">

            <!-- IMAGE AT TOP OF PAGE -->
            <p align="center"><label><a href="http://aitptest.weebly.com/">Back to AITP site</a></label></p>
            <img src="assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo">
            <br><br> <!--adds a little space between logo and text boxes -->

            <!-- TEXT ABOVE FIELD BOXES -->
            <h2 class="form-signin-heading">LV-AITP Login</h2>

            <?php if(isset($error)) {echo $error;} ?>

            <!--EMAIL AND PASSWORD TEXT FIELDS -->
            <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Email" autofocus>
            <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">

            <!-- THE SIGN IN BUTTON -->
            <?php
                if($blocked){//If user is blocked from overextending their ability to fail to log in, disable the
                    // log-in button totally.  Not the solution, just makes things look nice.
                    echo "<button type=\"submit\" disabled name=\"Submit\" class=\"btn btn-lg btn-primary btn-block\">";
                }
                //else just print out the regular damn button
                else
                    echo "<button type=\"submit\" name=\"Submit\" class=\"btn btn-lg btn-primary btn-block\">";
                ?>Sign in</button>

            <!-- LINKS UNDER THE SIGN IN BUTTON -->
            <p align="center"><label><a href = "login/forgot_password.php">Forgot Password?</a></label></p>
            <p align="center"><label>Don't have an account yet? <a href="login/signup.php">Sign up</a></label></p>
            


            <!-- FOR BOTTOM TESTING BUTTON -->
            <br><br><br><br><br><br><br><br><br> <!-- push to bottom for testing PLEASE REMOVE WHEN YOU'RE DONE -->

            <!--<a href="login/event.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">To Dashboard(For Testing)</a>-->
        
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

