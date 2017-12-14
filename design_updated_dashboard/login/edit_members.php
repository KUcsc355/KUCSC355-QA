<?php 
require "loginheader.php";
$my_id = $userRow['idUser'];
if(!$user->is_loggedin()||$userRow['priveledge']!=2)
{
    $user->redirect('../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Edit Member</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Material-Kit CSS -->
    <link href="../assets/css/material-kit.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="../assets/css/themify-icons.css" rel="stylesheet">


    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            margin: auto;
        }

        td, th {
            white-space:nowrap;
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #fffcf5;
        }
        tr:nth-child(odd) {
            background-color: #ffffff;
        }
        table.sortable th:not(.sorttable_sorted):not(.sorttable_sorted_reverse):not(.sorttable_nosort):after {
            content: " \25B4\25BE"
        }
    </style>

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
                    <img src="../assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo">
                </a>
            </div>

            <ul class="nav">
                <li>
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
                <li class="active">
                    <a href="edit_members.php">
                        <i class="ti-id-badge"></i>
                        <p>Edit Members</p>
                    </a>
                </li>
                <li>
                    <a href="create_event.php">
                        <i class="ti-calendar"></i>
                        <p>Create Event</p>
                    </a>
                </li>
                <li>
                    <a href="add_sponsor.php">
                        <i class="ti-star"></i>
                        <p>Add Sponsor</p>
                    </a>
                </li>
                <li>
                    <a href="mail.php">
                        <i class="ti-email"></i>
                        <p>Send Email</p>
                    </a>
                </li>
		<li>
		    <a href="get_reports.php">
		        <i class="ti-clipboard"></i>
			<p>Get Reports</p>
		    </a>
	    	</li>
            </ul>
        </div>
    </div>
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

<!-- MAIL FORM -->

                    <div class="col-lg-10 col-md-10">
                        <div class="card">
                            <div class="header">
                                <h3 class="title">Edit Members Status</h3>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <h4 class="title">Search User</h4><hr /><br>
                                    <?php if(isset($error)){echo $error;} ?>
                                    <div class="form-group" style='text-align: center;vertical-align: middle'>
                                        <label style='text-align: center;vertical-align: middle'>Search First Name, Last Name, or Email Address
                                        <input type="Search" style='margin:auto;' class="form-control border-input" name="cred" placeholder="" required/>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div><hr />
                                    <div class="text-center"><div class="click">
                                        <!--<input type='button' <buton type="submit" value='Search User' class="btn btn-info btn-fill btn-wd" id='btnAddProfile'></input></div>-->
                                        <button type="submit" name="btn-edit" class="btn btn-info btn-fill btn-wd"><i class="ti-search"></i> Search</button>
                                    </div>
                                </form><br>
                <?php
            //A quick and dirty way to make changes appear without the need to create a separate page.
            if(isset($_POST['btn-edit'])||isset($_POST['btn-change']))
            {
                $index = 0;
                //After the changes are made and the officer hits "submit" or "change" or whatever I named it.
                if(isset($_POST['btn-change']))
                {
                    //Grab each result from the user_status[] array created by the dropdown boxes
                    foreach ($_POST['user_status'] as $t_value) {

                        //Needed a way to pass 2 distinct (and not necessarily sequential)
                        // values via one array.  Multiply by 10, add the smaller.
                        // E.g. If ID is 47 and selected result (value) is 3, final 'encoded'
                        //   value is 473.  Then work backwards to extract them individually.
                        // Should the data type be a string, a nested for loop would be
                        //   required to perform the same end task, changing run time from
                        //  O(n) to O(n^2), and I ain't havin' none of that, ya feel?
                        $t_id = ($t_value-($t_value%10))/10;
                        $t_value = $t_value%10;

                        //Update the respective users, provided they are not the stats of the admin currently performing the action.
                        $stmt = $DB_con->prepare("UPDATE User SET priveledge = :val WHERE idUser=:uid AND idUser<>:my_id");
                        $stmt->bindParam(":val", $t_value);
                        $stmt->bindParam(":uid", $t_id);
                        $stmt->bindParam(":my_id", $my_id);
                        $stmt->execute();
                    }

                    $stmt=$DB_con->prepare("UPDATE User SET student = FALSE");
                    $stmt->execute();
                     foreach ($_POST['student'] as $t_student){
                        $stmt = $DB_con->prepare("UPDATE `User` SET student = TRUE WHERE idUser=:uid");
                        $stmt->bindParam(":uid", $t_student);
                        $stmt->execute();
                    }
                    foreach ($_POST['expiry'] as $row => $t_user){
                        foreach($t_user as $t_id => $t_date){
                            $stmt = $DB_con->prepare("UPDATE `User` SET expiry = :val WHERE idUser=:uid");
                            $stmt->bindParam(":val", $t_date);
                            $stmt->bindParam(":uid", $t_id);
                            $stmt->execute();
                        }
                    }
                    foreach ($_POST['deletion'] as $t_delete){
                        $stmt = $DB_con->prepare("DELETE FROM `User` WHERE idUser=:uid AND idUser<>:my_id");
                        $stmt->bindParam(":uid", $t_delete);
                        $stmt->bindParam(":my_id", $my_id);
                        $stmt->execute();
                    }

                    echo "<p>User(s) changed successfully!</p>";
                }
                echo "<form method='post'><table style='table-layout:fixed;max-width:60%;'>
                    <col style=\"width:100%\"/>
                    <col/>
                    <tr><th>Name</th><th>Email Address</th><th style='max-width:20%;'>Account Level</th><th>Student Account?</th><th>Account Expiry</th><th>Delete User?</th></tr>";
                $page = $DB_con->prepare("SELECT idUser, fName, lName, email, priveledge, student, expiry FROM User WHERE fName=:uname OR lName=:uname OR email=:uname");
                $page->bindParam(":uname", $_POST['cred']);
                $page->execute();

                //Grab everything that readily identifies a user. Repeat for as long as the result has unique results.
                while ($row = $page->fetch(PDO::FETCH_ASSOC)){
                    $id = $row['idUser'];
                    $fName = $row['fName'];
                    $lName = $row['lName'];
                    $email = $row['email'];
                    $officer = $row['priveledge'];
                    $student = $row['student'];
                    $date = $row['expiry'];
                    $value = $id*10; //Prep the value for making that 'encoded' value to schlep through the array post

                    //Here's where some crafty php comes into play; each line adds another value to populate a dropdown box,
                    //  of which the encoded value (id concatenated with desired value) will be added to an arbitrary place in
                    //  the user_status[] array.  This repeats for every user found by the SQL statement.  Then, as a default,
                    //  whatever position the user holds will be selected and greyed out.
                    echo "<tr>
                            <td>" . $lName . ", " . $fName . "</td>
                            <td>" . $email . "</td>
                            <td>
                                <select style='margin:auto;'name='user_status[]'>
                                <option value=" . ($value+0); if($officer==0)echo " selected disabled"; echo " id=" . $id . ">Non-Member</option>";
                    echo       "<option value=" . ($value+1); if($officer==1)echo " selected disabled"; echo " id=" . $id . ">Member</option>";
                    echo       "<option value=" . ($value+2); if($officer>=2)echo " selected disabled"; echo " id=" . $id . ">Officer</option>";

                    echo        "</select> </td>
                                <td style='text-align:center;vertical-align:middle;'><label for='student'>
                                <input type='checkbox' name='student[]' value='$id'";  if($student){echo ' checked';} echo "> 
                                </label></td>
                                <td><label for='expiry'>
                                <input type='date' class='datepicker' name='expiry[$index][$id]' value='$date' min='" . date('Y-m-d') . "'>
                                </label></td>
                                <td style='text-align:center;vertical-align:middle;'><label for='deletion'>
                                <input type='checkbox' name='deletion[]' value='$id'>
                                </label></td>
                          </tr>";

                    $index++;

                }
                echo "</table>";

                //Only display the button to change users' statuses if the button hasn't been pressed yet.
                if(!isset($_POST['btn-change'])) {
                    echo "<br><div class=\"click\">
                            <button type=\"submit\" name=\"btn-change\" class=\"btn btn-info btn-fill btn-wd\">Change Users
                            </button>
                        </div></form>";
                }
            }
            ?>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </form>
        
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
        
        
        
    </body>
    

        <!--   Core JS Files   -->
        <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

        <!--  Checkbox, Radio & Switch Plugins -->
        <script src="../assets/js/bootstrap-checkbox-radio.js"></script>

        <!--  Notifications Plugin    -->
        <script src="../assets/js/bootstrap-notify.js"></script>

        <!-- Paper Dashboard Core JavaScript FOR HAMBURGER KEEP HANDS OFF -->
        <script src="../assets/js/paper-dashboard.js"></script>

</html>