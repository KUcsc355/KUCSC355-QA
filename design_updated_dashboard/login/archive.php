<?php
//This header should be included on every page;
//  it grabs user data from either the database or
//  their session variable
require_once 'loginheader.php';

if(!$user->is_loggedin())
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
                <li class="active">
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
		<!--
        <div class="content">
            <div class="container-fluid">
                <div class="row">
		-->
<!-- MAIL FORM -->

		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Archived Events for Members</h4>
                                <p class="category">Get started by selecting a year</p>
                            <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<p>Select Year <b class="caret"></b></p>
                              </a>

                            <ul class="dropdown-menu">
                                <li><a href="#">2017-2018</a></li>
                                <li><a href="#">2016-2017</a></li>
                                <li><a href="#">2015-2016</a></li>
                                <li><a href="#">2014-2015</a></li>
                                <li><a href="#">2013-2014</a></li>
                                <li><a href="#">2012-2013</a></li>
                            </ul>
                            </li>


                            </div>


                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>Year</th>
                                        <th>Name</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2017-2018</td>
                                        	<td>Cybersecurity Summit</td>
                                        	<td>Open</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                        	<td>DeSales Data Analytics</td>
                                        	<td>Open</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><?php /*$event->retrieveEvents()[10]["name"]; */ $event->post();?></td>
                                            <td>Open</td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
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
                        <a href="https://opensource.org/licenses/MIT">
                            MIT License (temp)
                        </a>
                    </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="ti-heart"></i> by the <strong>wonderful CSC355 Design Team</strong></a>
                </div>
            </div>
        </footer>

<!-- /FOOTER -->
<?php //event->post(); ?>
    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio.js"></script>

    <!-- Paper Dashboard Core JavaScript FOR HAMBURGER KEEP HANDS OFF -->
    <script src="../assets/js/paper-dashboard.js"></script>

</html>
