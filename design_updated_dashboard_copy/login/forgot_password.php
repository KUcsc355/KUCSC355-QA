<?php
/*<!--
<--------------------------------------------\
< Author: Tyler Stoney                       \
< Date of Creation: October 25, 2017         \
< Purpose: Allow user to request a temporary \
<          password in case they forget      \
<          their current one; temp password  \
<          is sent to the email they specify \
<          <FRONTEND/BACKEND>                \
<--------------------------------------------\
-->*/


require_once 'dbconfig.php';
// Modify the path in the require statement below to refer to the 
// location of your Composer autoload.php file.
require '/home/ubuntu/vendor/autoload.php';
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if($user->is_loggedin())
{
    $user->redirect('index.php');
}


if(isset($_POST['btn-email']))
{

    //Quick and dirty way to make a random string. Thanks, StackOverflow, IOU1 fam,
    //  you saved me like 5 minutes of typing
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 5; $i++) { //I make the password 5 characters exactly for another hacky and
                                 //  cheap trick, explained in more detail in the login page.
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    //grab email from the user's stat
    $umail = $_POST['umail'];
    try { //Attempt to pull the user associated with that email
        $stmt = $DB_con->prepare("SELECT * FROM `User` WHERE `email`=:umail");
        $stmt->execute(array(":umail" => $umail));
        $uRow = $stmt->fetch(PDO::FETCH_ASSOC);
        $recipient = $uRow['fName'] . " " . $uRow['lName'];

        if($stmt->rowCount()>0) {
            //hash the temp password to prep it for storage
            $new_pass = password_hash($randomString, PASSWORD_DEFAULT);

            // Instantiate a new PHPMailer 
            $mail = new PHPMailer;

            // Tell PHPMailer to use SMTP
            $mail->isSMTP();

            // Replace sender@example.com with your "From" address. 
            // This address must be verified with Amazon SES.
            $mail->setFrom('lvaitpsite@gmail.com', 'DO NOT REPLY');

            // Replace recipient@example.com with a "To" address. If your account 
            // is still in the sandbox, this address must be verified.
            // Also note that you can include several addAddress() lines to send
            // email to multiple recipients.
            $mail->addAddress($umail, $recipient);

            // Replace smtp_username with your Amazon SES SMTP user name.
            $mail->Username = 'AKIAJTUQUOQTLB3QICSQ';

            // Replace smtp_password with your Amazon SES SMTP password.
            $mail->Password = 'ApZxAKOnImS6Gyqzw8oRFXRyKsNCJ8Xl9hp2PBryRY9D';
                
            // Specify a configuration set. If you do not want to use a configuration
            // set, comment or remove the next line.
            //$mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');
             
            // If you're using Amazon SES in a region other than US West (Oregon), 
            // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP  
            // endpoint in the appropriate region.
            $mail->Host = 'email-smtp.us-east-1.amazonaws.com';

            // The subject line of the email
            $mail->Subject = 'AITPTest - Password Change Request';

            // The HTML-formatted body of the email
            $mail->Body = "Your temporary password is: \n"
                . $randomString
                . "\nPlease log in with this password to change your password\n"
                . " as soon as possible.";

            // Tells PHPMailer to use SMTP authentication
            $mail->SMTPAuth = true;

            // Enable TLS encryption over port 587
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Tells PHPMailer to send HTML-formatted email
            $mail->isHTML(true);

            // The alternative email body; this is only displayed when a recipient
            // opens the email in a non-HTML email client. The \r\n represents a 
            // line break.
            $mail->AltBody = "Your temporary password is: \n"
                . $randomString
                . "\nPlease log in with this password to change your password\n"
                . " as soon as possible.";

            if($mail->send()) {
                $error = "Email sent to " . $umail; //I hate myself for abusing the $error message system, but it works. :(
                //store the password
                $stmt = $DB_con->prepare("UPDATE `User`
                                        SET password = :upass
                                        WHERE email=:umail");
                $stmt->bindparam(":upass", $new_pass);
                $stmt->bindparam(":umail", $umail);
                $stmt->execute();
                header("Location: forgot_password.php?success");
                exit();
            }  else $error = "Email not sent. " . $mail->ErrorInfo . PHP_EOL;
        } else $error = "An account with that email is not registered."; 
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}



if(isset($_GET['success'])){
    $error = "An email with a temporary password was sent to your inbox!"; //I hate myself for abusing the $error message system, but it works. :(
}

?>
<!--<!DOCTYPE html>-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>AITP Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../assets/css/logincss/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../assets/css/logincss/main.css" rel="stylesheet" media="screen">

    <!----THESE 4 ARE MAKING THE CURRENT THEME ---->
            <!-- Bootstrap core CSS    
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
    <!----THESE 4 ARE MAKING THE CURRENT THEME ---->

  </head>
  
  <body>
    <div class="container">

        <!-- ACTION REDIRECTS THE PAGE TO THE SIGNED_IN PAGE -->
        <form class="form-signin" name="form1" method="post">

            <!-- IMAGE AT TOP OF PAGE -->
            <img src="../assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo">
            <br><br> <!--adds a little space between logo and text boxes -->

            <!-- TEXT ABOVE FIELD BOXES -->
            <h2 class="form-signin-heading">Forgot Password</h2>

            <br>
            <br>

            <!-- <div class="container"> -->
            <div class="form-container">
            <form method="post">

            <?php
            if(!isset($_GET['success'])&&isset($error))
            {
            ?>

                <div class="alert alert-danger">
                    <i class="ti-alert"></i> &nbsp; <?php echo $error; ?>
                </div>
            

            <?php
            }
            
            else if(isset($_GET['success']))
            {
            ?>
            
            <div class="alert alert-info">
                <?php echo $error; ?>
            </div>
            
            <?php //Well, at least it wasn't called as an $error. bleh
            }
            ?>

            <div class="form-group">
                <input type="text" class="form-control" name="umail" placeholder="Email address" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
                <button type="submit" name="btn-email" class="btn btn-block btn-primary">Send Email
                </button>
            </div>
            <p>Back to sign in: <a href='../index.php'>Login</a></p>
        </form>
    </div>
</div>
<br><br>

</body>
</html>
