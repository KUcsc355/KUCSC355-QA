<?php
//This header should be included on every page;
//  it grabs user data from either the database or
//  their session variable
require 'loginheader.php';
$my_id = $userRow['idUser'];

if(!$user->is_loggedin())
{
    $user->redirect('../index.php');
}

//Upon pushing the button...
if(isset($_POST['btn-pass']))
{
    //Grab the data entered in the fields
    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password_1'];

    //Simple error checking and consistency
    if(strlen($new_pass) < 6){
        $error[] = "Password must be at least 6 characters";
    }
    //Make sure they match
    else if($new_pass!=$_POST['new_password_2']) {
        $error[] = "Passwords don't match.";
    }
    else {//If everything is good, then go ahead with the rest
        try {
            //Grab the user's info
            $stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:uid");
            $stmt->execute(array(':uid' => $my_id));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);

            //If the user exists, make sure his old password is correct.
            //  Don't want any ne'er-do-wells tryin' to change other people's
            //  passwords all willy-nilly, now, do we?
            if ($stmt->rowCount() > 0) {
                if (password_verify($old_pass, $userRow['password'])) {
                    if($user->change_password($my_id, $new_pass)){
                        $user->redirect('change_password.php?success');
                    }
                    else{$error[]="You probably shouldn't ever see this, sending our monkeys to fix it; refresh the page and try again.";}
                } else {
                    $error[] = "Wrong Password";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>User Profile</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
    
    <style>
    .eye {
    opacity: 0.4;
    transition: opacity .1s ease-in-out;
    -moz-transition: opacity .1s ease-in-out;
    -webkit-transition: opacity .1s ease-in-out;
    }
    .eye:hover {
        opacity: 1.0;
        transition: opacity .25s ease-in-out;
        -moz-transition: opacity .25s ease-in-out;
        -webkit-transition: opacity .25s ease-in-out;
    }
    .eyeOpen {
    opacity: 1.0;
    transition: opacity .1s ease-in-out;
    -moz-transition: opacity .1s ease-in-out;
    -webkit-transition: opacity .1s ease-in-out;
    }
    </style>

<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
</head>
<body>

<!-- SIDEBAR -->

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="info">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                        <img src="../assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo"> <!--AITP Portal-->
                </a>
            </div>

            <ul class="nav">
                
                <li class="active">
                    <a href="user.php">
                        <i class="ti-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="signup_event.php">
                        <i class="ti-pencil"></i>
                        <p>Event Signup</p>
                    </a>
                </li>
                <li>
                    <a href="archive.php">
                        <i class="ti-archive"></i>
                        <p>Archived Events</p>
                    </a>
                </li>
                <?php
                if($userRow['priveledge']==2) {
                echo "
                <li>
                    <a href='edit_members.php'>
                        <i class='ti-id-badge'></i>
                        <p>Edit Members</p>
                    </a>
                </li>
                <li>
                    <a href='create_event.php'>
                        <i class='ti-calendar'></i>
                        <p>Create Event</p>
                    </a>
                </li>
                <li>
                    <a href='add_sponsor.php'>
                        <i class='ti-star'></i>
                        <p>Add Sponsor</p>
                    </a>
                </li>
                <li>
                    <a href='mail.php'>
                        <i class='ti-email'></i>
                        <p>Send Email</p>
                    </a>
                </li>
        <li>
            <a href='get_reports.php'>
                <i class='ti-clipboard'></i>
            <p>Get Reports</p>
            </a>
        </li>";}
                ?>

            </ul>
        </div>
    </div>

<!-- /SIDEBAR -->

    <div class="main-panel"> <!-- DIV CONTAINING WHOLE PAGE -->

<!-- TOP NAV BAR -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- hamburger -->
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand">Dashboard</a>
                </div> <!-- /navbar-header -->

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="http://aitptest.weebly.com">
                                <p>LV-AITP Homepage</p>
                            </a>
                        </li>
                        <li>
                            <!--<a href="../index.php"> --><!-- do not toggle logout or it will not work -->
                                <a href='logout.php?logout=true\'>
                                <i class="ti-power-off"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </div> <!-- /collapse navbar-collapse -->
            </div> <!-- /container-fluid -->
        </nav>
<!-- /TOP NAV BAR -->

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    
<!-- USER DISPLAY BOX
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image">
                                <img src="../assets/img/happydog.gif" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="../assets/img/faces/happy-face.jpg" alt="..."/>
                                  <h4 class="title">Bark Wahlberg<br />
                                  </h4>
                                </div>
                            </div>
                        </div>
                    </div>
/USER DISPLAY BOX -->

<!-- PROFILE INFORMATION -->


                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Change Password</h4>
                            </div>
                            <div class="content">
                                 <?php
                                    if(isset($error))
                                    {
                                        foreach($error as $error) { echo 
                                            "<div class='alert alert-danger'>
                                            <i class='ti-alert'> $error </i> &nbsp; </div>"; 
                                        }
                                    }
                                    else if(isset($_GET['success']))
                                    {
                                        ?>
                                        <div class="alert alert-info">
                                            Successfully changed!
                                        </div>
                                        <?php //Well, at least it wasn't called as an $error. bleh
                                    }
                                ?>
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">                                        
                                                <input type="password" class="form-control" style="overflow: hidden;" name="old_password" placeholder="Old Password" required >
                                            </div>
                                        </div>
                                        <button type="button" class="eye" name="eye" id="eye0" tabindex="-1" style="padding: 15px; vertical-align: middle; background-color: #FFFFFF; border: none;" 
                                                    onclick="if(old_password.type=='password'){
                                                                old_password.type='text';
                                                                eye0.className='eyeOpen';
                                                            }else { 
                                                                old_password.type='password';
                                                                eye0.className='eye';
                                                                }">
                                                    <i class="ti-eye"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="new_password_1" placeholder="New Password" 
                                                title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" 
                                                pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required />
                                            </div>
                                        </div>
                                        <button type="button" class="eye" name="eye" id="eye1" tabindex="-1" style="padding: 15px; vertical-align: middle; background-color: #FFFFFF; border: none;" 
                                                    onclick="if(new_password_1.type=='password'){
                                                                new_password_1.type='text';
                                                                eye1.className='eyeOpen';
                                                            }else { 
                                                                new_password_1.type='password';
                                                                eye1.className='eye';
                                                                }">
                                                    <i class="ti-eye"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="password" class="form-control" name="new_password_2" placeholder="New Password (again)" 
                                                title="Repeat Password"
                                                pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required />
                                            </div>
                                        </div>
                                        <button type="button" class="eye" name="eye" id="eye2" tabindex="-1" style="padding: 15px; vertical-align: middle; background-color: #FFFFFF; border: none;" 
                                                    onclick="if(new_password_2.type=='password'){
                                                                new_password_2.type='text';
                                                                eye2.className='eyeOpen';
                                                            }else { 
                                                                new_password_2.type='password';
                                                                eye2.className='eye';
                                                                }">
                                                    <i class="ti-eye"></i>
                                        </button>
                                    </div>
                                            <div class="clearfix"></div><hr />
                                                <div class="form-group">
                                                    <button type="submit" name="btn-pass" class="btn btn-block btn-primary">Change Password
                                                    </button>
                                                </div>
                                        
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
<!-- /PROFILE INFORMATION -->

<!-- FOOTER -->

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="https://www.aitp.org/benefits">
                                Benefits
                            </a>
                        </li>

                        <li>
                            <a href="https://certification.comptia.org">
                                Certs
                            </a>
                        </li>

                        <li>
                            <a href="https://www.aitp.org/benefits/training">
                                Training
                            </a>
                        </li>

                        <li>
                            <a href="https://www.aitp.org/benefits/it-job-board">
                                Job Search
                            </a>
                        </li>

                        <li>
                            <a href="https://www.aitp.org/benefits/it-research">
                                Research
                            </a>
                        </li>

                        <li>
                            <a href="https://www.comptia.org/advocacy">
                                Advocacy
                            </a>
                        </li>

                        <li>
                            <a href="https://www.aitp.org/join-now/?tracking=?page=JoinAITPpro">
                                Join
                            </a>
                        </li> 

                    <li>
                    &copy; <script>document.write(new Date().getFullYear())</script>
                    </li>
                    </ul>
                </nav>
            </div>
        </footer>

<!-- /FOOTER -->

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio.js"></script>

    <!--  Notifications Plugin    -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!--
    <script type="text/javascript">
        $(document).ready(function(){

            $.notify({
                icon: 'ti-gift',
                message: "Welcome to the <b>LV-AITP Dashboard</b> - a location to get all your LV-AITP resources!"

            },{
                type: 'success',
                timer: 1500
            });

        });
    </script>
    -->

</html>
