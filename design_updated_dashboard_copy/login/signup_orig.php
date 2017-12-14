<?php require "loginheader.php"; 

function validate_edu($email){
  $email = explode(".",$email);
  if($email[count($email)-1] == "edu" || $email[count($email)-2] == "edu")
    return true;
  else
    return false;
}

/*<!--
<--------------------------------------------\
< Author: Tyler Stoney                       \
< Date of Creation: October 25, 2017         \
< Purpose: Allow person to register account  \
<          with the site.                    \
<          <FRONTEND/BACKEND>                \
<--------------------------------------------\
-->*/


if(isset($_POST['Submit']))
{
    $umail = trim($_POST['email']);
    $upass = trim($_POST['password1']);
    $fName = trim($_POST['fname']);
    $lName = trim($_POST['lname']);
    $membership = trim($_POST['membershipType']);

    if($umail=="") {
        $error[] = "Email can't be left blank!";
    }
    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address!';
    }
    else if($membership==="student"&&!validate_edu($umail)){
        $error[] = '"' . $umail . '" is not a valid university email address.';
    }
    else if($upass=="") {
        $error[] = "Password field can't be left blank!";
    }
    else if(strlen($upass) < 6){
        $error[] = "Password must be at least 6 characters.";
    }
    else if($upass!=$_POST['password2']){
        $error[] = "Passwords don't match";
    }
    else if($fName=="") {
        $error[] = "First name field can't be left blank!";
    }
    else if($lName=="") {
        $error[] = "Last name field can't be left blank!";
    }
    else
    {
        try
        {
            $stmt = $DB_con->prepare("SELECT email FROM `User` WHERE email=:umail");
            $stmt->execute(array(':umail'=>$umail));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            if($row['email']==$umail) {
                $error[] = "Email address already in use";
            }
            else
            {
                if($user->register($fName,$lName,$umail,$upass,$membership))
                {
                    $user->redirect('signup.php?joined');
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../assets/css/logincss/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../assets/css/logincss/main.css" rel="stylesheet" media="screen">
        <!-- Bootstrap core CSS     -->
    <!--<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    Animation library for notifications 
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

     Paper Dashboard core CSS    
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>-->

    <!--  Fonts and icons     -->
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

      <!--Use this later <form class="form-signup" id="usersignup" name="usersignup" method="post" action="reg_submit.php">-->
	  <form class="form-signup" id="usersignup" name="usersignup" method="post">
	
	<p align="center"><label><a href="http://aitptest.weebly.com/">Back to AITP site</a></label></p>
        <img src="../assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo">
            <br><br> <!--adds a little space between logo and text boxes -->
        <h2 class="form-signup-heading">Register for LV-AITP</h2>
         <?php
            if(isset($error))
            {
                foreach($error as $error) { echo 
                    "<div class='alert alert-danger'>
                    <i class='ti-alert'> $error </i> &nbsp; </div>"; }
            }
            else if(isset($_GET['joined']))
            {
                echo "<div class='alert alert-info'>
                    Successfully registered! <a href='../index.php'>login here</a>
                    </div>";
            }
            ?>
			
		<label for="membershipType">Please select your membership type.</label>
		<br>
		<input type="radio" name="membershipType" value="regular" checked="checked">
		<label for="regular">Regular &nbsp;&nbsp;</label>
		<input type="radio" name="membershipType" value="student">
		<label for="student">Student </label>
		<br>
        <input name="fname" id="fname" type="text" class="form-control" placeholder="First Name" required> <br>
        <input name="lname" id="lname" type="text" class="form-control" placeholder="Last Name" required> <br>
		
	
		
        <input name="email" id="email" type="email" class="form-control" placeholder="Email" required> <br>
        <p> Password must contatin at least 6 characters, one upper case, and one symbol</p>
        <input name="password1" id="password1" type="password" class="form-control" placeholder="Password" 
            title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" 
            pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
        <input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password" 
            title="Repeat Password" 
            pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>

        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

        <p align="center"><label>Already have an account? <a href="../index.php">Sign in</a></label></p>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->
  </body>
</html>
