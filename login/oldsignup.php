<?php
/*<!--
<--------------------------------------------\
< Author: Tyler Stoney                       \
< Date of Creation: October 25, 2017         \
< Purpose: Allow person to register account  \
<          with the site.                    \
<          <FRONTEND/BACKEND>                \
<--------------------------------------------\
-->*/


require_once 'dbconfig.php';
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['Submit']))
{
    $umail = trim($_POST['email']);
    $upass = trim($_POST['password1']);
    $fName = trim($_POST['firstname']);
    $lName = trim($_POST['lastname']);


    if($umail=="") {
        $error[] = "Email can't be left blank!";
    }
    else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Please enter a valid email address!';
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
                if($user->register($fName,$lName,$umail,$upass))
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
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <div class="container">

      <form class="form-signup" id="usersignup" name="usersignup" method="post" action="#">
        <h2 class="form-signup-heading">Register</h2>
        <input name="firstname" id="firstname" type="text" class="form-control" placeholder="First Name">
        <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Last Name">
        <br>

        <input name="email" id="email" type="text" class="form-control" placeholder="Email">
        <br>

        <input name="password1" id="password1" type="password" class="form-control" placeholder="Password">
        <input name="password2" id="password2" type="password" class="form-control" placeholder="Repeat Password">

        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>

        <p align="center"><label>Already have an account? <a href="main_login.php">Sign in</a></label></p>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>

    <!-- <script src="js/signup.js"></script> -->


    <!-- <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script> -->
    <!-- <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script> -->

<!-- 	<script>

	$( "#usersignup" ).validate({
	  rules: {
		email: {
			email: true,
			required: true
		},
	    password1: {
	      required: true,
	      minlength: 4
		},
	    password2: {
	      equalTo: "#password1"
	    }
	  }
	});
	</script> -->

  </body>
</html>
