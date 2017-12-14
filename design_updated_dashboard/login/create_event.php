<?php
//This header should be included on every page;
//  it grabs user data from either the database or
//  their session variable
require_once 'dbconfig.php';
require_once '../../event/settings.php';
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$user->is_loggedin())
{
    $user->redirect('../index.php');
}
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

    <title>Create Event</title>

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

    <!-- DatePicker CSS -->
    <link rel="stylesheet" href="./assets/css/bootstrap-datepicker3.min.css">
    <script src="./assets/js/bootstrap-datepicker.min.js"></script>

    <!-- TimePicker CSS -->


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
					<li>
						<a href="edit_members.php">
								<i class="ti-id-badge"></i>
								<p>Edit Members</p>
						</a>
					</li>
					<li class ="active">
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
<!-- EVENT FORM -->
						<div class="col-lg-8 col-md-7">
							<div class="card">
								<div class="header">
									<h3 class="title">Add Event</h3>
								</div>
								<div class="content">
									<form>
										<h5 class="title">Details</h5>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>Event Name</label></div>
													<input name="event" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label>Speaker(s)</label>
													<input name = "speaker" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>Date</label></div>
														<div class="input-group date">
															<input name="date" type="text" class="form-control"><span class="input-group-addon" placeholder="dd/mm/yyyy"><i class="ti-calender"></i></span>
														</div>
												</div>
											</div>
										</div>

										<h5 class="title">Location</h5>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<div class="required"><label>Street Address</label></div>
													<input name="streetAdd" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="required"><label>City</label></div>
													<input name="city" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="required"><label>ZIP</label></div>
													<input name="zip" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>Fee</label></div>
													<input name="fee" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Description</label>
													<textarea name="description" rows=5 type="text" class="form-control border-input" placeholder=""></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div-class="form-group">
													<p>* Required</p>
												</div>
											</div>
										</div>

										<div class="text-center">
										  <button type="submit" class="btn btn-info btn-fill btn-wd">Create Event</button>
										</div>
										<br>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
<!-- /Event Form -->

    <?php
        //echo($event->retrieveEvents()[0]["name"]);
        if (trim($_POST['event']) !== "" &&
            trim($_POST['description']) !== "" &&
            isset($_POST['event'], $_POST['date'], $_POST['streetAdd'],
            $_POST['city'], $_POST['zip'], $_POST['fee'], $_POST['description'])) {
            // Store it.
            $name           = $_POST['event'];
            $speaker        = isset($_POST['speaker']) ? $_POST['speaker'] : "";
            $date           = $_POST['date'];
            $street1        = $_POST['streetAdd'];
            $city           = $_POST['city'];
            $zip            = $_POST['zip'];
            $fee            = $_POST['fee'];
            $description    = $_POST['description'];
            //$eventTime      = getTime($_POST['eventTime']);

            //$event->createEvent($name, $speaker, $date, $street1, $city, $zip, $fee, $description);
        }
    ?>

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
						&copy; <script>document.write(new Date().getFullYear())</script>
					</div>
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

    <!-- Paper Dashboard Core JavaScript FOR HAMBURGER KEEP HANDS OFF -->
    <script src="../assets/js/paper-dashboard.js"></script>

    <script>
        $('#sandbox-container .input-group.date').datepicker({
        keyboardNavigation: false
        });
    </script>

</html>
