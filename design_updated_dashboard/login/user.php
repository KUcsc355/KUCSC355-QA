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

if(isset($_POST['btn-change']))
{

        $stmt = $DB_con->prepare("UPDATE `User` SET fName = :fName, lName = :lName, street1 = :street1, company = :company, city = :city WHERE idUser=:uid");
            $stmt->bindParam(":fName", $_POST['fName']);
            $stmt->bindParam(":lName", $_POST['lName']);
            $stmt->bindParam(":street1", $_POST['street1']);
            $stmt->bindParam(":company", $_POST['company']);
            $stmt->bindParam(":city", $_POST['city']);
            $stmt->bindParam(":uid", $my_id);
            $stmt->execute();

        $result = $DB_con->prepare("SELECT COUNT(*) FROM `User` WHERE `email` LIKE :umail AND `idUser` <> :my_id");
        $result->bindParam(":umail", $_POST['email']);
        $result->bindParam(":my_id", $userRow['idUser']);
        $result->execute();
        $count=$result->fetch(PDO::FETCH_NUM);

        if($count[0]==0){ 
            $stmt = $DB_con->prepare("UPDATE `User` SET email = :umail WHERE idUser=:my_id");
               $stmt->bindParam(":umail", $_POST['email']);
               $stmt->bindParam(":my_id", $my_id);
               $stmt->execute();
               header("Location: user.php?success");
        }else {
            $error = "Email address is already taken, please enter another.";
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

<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var button = $('.form-control');
            $(button).prop('disabled', true);

            $('.click').click(function() {
                if ($(button).prop('disabled')){ 
                    $(button).prop('disabled', false); 
                    $('.btn').prop('value', 'Save'); 
                }else { 
                    //$(button).prop('disabled', true);
                    $('.btn').prop('value', 'Edit Profile');
                    $('.btn').prop("type", "submit");
                    $('.btn').prop("formmethod", "submit");
                };
            });

        });

</script>
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
                                <i class="ti-home"></i>
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

<!-- PROFILE INFORMATION -->
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title"><?php getPrivilege($userRow['priveledge']); ?> Information</h4>
                            </div>
                            <div class="content">
                                <?php
                                    if(isset($error))
                                    {
                                        echo 
                                            "<div class='alert alert-danger'>
                                            <i class='ti-alert'> $error </i> &nbsp; </div>"; 
                                    }else if(isset($_GET['success']))
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input name=fName type="text" class="form-control border-input" placeholder="First Name" value="<?php echo $userRow['fName']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name=lName type="text" class="form-control border-input" placeholder="Last Name" value="<?php echo $userRow['lName']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input name=email type="email" class="form-control border-input" placeholder="Email" value="<?php echo $userRow['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <input name=company type="text" class="form-control border-input" placeholder="Company" value="<?php echo $userRow['company']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name=street1 type="text" class="form-control border-input" placeholder="Address" value="<?php echo $userRow['street1']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input name=city type="text" class="form-control border-input" placeholder="City" value="<?php echo $userRow['city']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center"><div class="click">
                                        <input name='btn-change' id='btn-change' value='Edit Profile' class="btn btn-info btn-fill btn-wd" type='button'></input></div>
                                        <!--<button type="button" class="btn btn-info btn-fill btn-wd">Edit Profile</button></div>-->
                                    </div>
                                </form>
                                <a href="change_password.php">Change Password</a>
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
    <!--  Only important if you want the notify banner at the top of the page -->
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!-- Paper Dashboard Core JavaScript FOR HAMBURGER KEEP HANDS OFF -->
    <script src="../assets/js/paper-dashboard.js"></script>

    
    <script type="text/javascript">
        $(document).ready(function(){

            $.notify({
                icon: 'ti-announcement',
                title: "<strong>Welcome, <?php echo $userRow['fName']; ?>!</strong>",
                message: "Welcome to the <b>LV-AITP Dashboard</b> - a location to get all your Lehigh Valley AITP resources!"

            },{
                type: 'info',
                placement: {
                    from: "top",
                    align: "center"
                },
                timer: 1500
            });

        });
    </script>
    

</html>
