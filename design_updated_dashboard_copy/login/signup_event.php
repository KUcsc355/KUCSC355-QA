<?php
include_once 'dbconfig.php';
require "loginheader.php";
if(!$user->is_loggedin())
{
    $user->redirect('../index.php');
}

$eventinfo = $event->getAllEventInfo();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Archived Events</title>

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

    <!-- Material-Kit CSS -->
    <link href="../assets/css/material-kit.css" rel="stylesheet"/>

</head>
<body>

<!-- SIDEBAR -->

<!-- SIDEBAR -->

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="info">
        <div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                        <img src="../assets/img/loginimg/aitp_logo.png" alt="LV-AITP Logo"> <!--AITP Portal-->
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="user.php">
                        <i class="ti-user"></i>
                        <p><?php echo $userRow['fName'] . " " . $userRow['lName']; ?></p>
                    </a>
                </li>
                <li class='active'>
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

<!-- MAIL FORM -->

<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Event Signup</h4>
                            </div>

                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody>
					    <?php
    					    $idarray = array();
    						$counter = 0;

				            foreach ($eventinfo as $anEvent) {
					    	   echo "<tr><td name=\"eventid\" id=\"eventid\" hidden>" . $anEvent["eventID"] . "</td>";
                               $eventID = $anEvent["eventID"];

    						   echo "<form class='form-signupevent' id='signupevent' name='signupevent' method='post'>";
    						   echo "<td>" . $anEvent["name"] . "</td>";
    						   echo "<td>" . $anEvent["street1"] . "</td>";
    						   echo "<td>" . preg_split("/[\s]/", $anEvent["date"])[0] . "</td>";
    						   echo "<td><button name= 'Submit' value = '{$anEvent['eventID']}' id=\"Submit\" type=\"submit\">signup</button></td></tr>";


    						   echo "</form>";
                           }

                           if (isset($_POST['Submit'])) {
                               $eventID = $_POST['Submit'];
                               $userID = $user_id;
                               $event->register($eventID, $userID);

                               if (isset($error))
                               {
                                   foreach ($error as $error) {
                                       echo
                    					 	"<div class='alert alert-danger'>
                    						<i class='ti-alert'> $error </i> &nbsp; </div>";
                                    }
                                }
                                else if(isset($_GET['joined']))
                                {
                						echo "<div class='alert alert-info'>
                    						Successfully registered for event!
                    						</div>";
           						 }
                             }

							$counter++;



					    //print_r($idarray);
					    ?>
                                    </tbody>
                                </table>
							</div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- New -->
		</div>
		</div>
		</div>

<!-- /MAIL FORM -->

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
                    <li>
                      <a href="https://www.linkedin.com/groups/4487916/profile" target="_blank"><i class='ti-linkedin'></i></a>
                    </li>
                    <li>
                      <a href="https://www.facebook.com/CompTIAAITP/" target="_blank"><i class='ti-facebook'></i></a>
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


</html>
