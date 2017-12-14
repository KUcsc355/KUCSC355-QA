<?php
include_once 'dbconfig.php';

require "loginheader.php";
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

    <title>Get Reports</title>

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
					<li class="active">
						<a href='get_reports.php'>
							<i class='ti-clipboard'></i>
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


			<!-- MAIN CONTENT FOUND HERE -->
			<!-- DROP DOWN MENU -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-8 col-md-7">
							<div class="card">
								<div class="header">
									<h4 class="title">Get Reports</h4>
								</div>
								</br>

								<div class="dropdown">
									<button class="btn btn-primary dropdown-toggle" name="eventNames" type="button" data-toggle="dropdown">Choose Event
									<span class="caret"></span></button>
									<ul class="dropdown-menu" id="user-dropdown-menu">
										<!-- GOOD DROPDOWN MENU HERE!! -->
										<?php
										try{
											$conn = new mysqli('lvaitpsitedb.c8yagni7c74b.us-east-2.rds.amazonaws.com', 'awsuser', 'Kutztown', 'lvaitpdb')
											or die ('Cannot connect to db');

											$result = $conn->query("SELECT idUser, fname FROM User");

											while ($row = $result->fetch_assoc())
											{
												unset($firstName);
												unset($idUser);
												$firstName = $row['fname'];
												$idUser = $row['idUser'];
												echo '<li><a href="#" id="' .$idUser. '">' .$firstName. '</a></li>';

											}
										}catch (Exception $e) {
										    echo 'Caught exception: ' .   $e->getMessage() . "\n";
										}
										?>
									</ul>
								</div>

								<div class="content">
									<form>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label>Event Name</label>
													<input type="text" class="form-control border-input" id="eventNameId" value="" disabled placeholder>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label>Speaker(s)</label>
													<input type="text" class="form-control border-input" id="speakerId" value="" disabled placeholder>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label>Date</label>
													<input type="text" class="form-control border-input" id="dateId" value="" disabled placeholder>
												</div>
											</div>
										</div>
										<h5 class="title">Location</h5>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Street Address</label>
													<input type="text" class="form-control border-input" id="locationId" value="" disabled placeholder>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>City</label>
													<input type="text" class="form-control border-input" id="cityId" value="" disabled placeholder>
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<label>Zip</label>
													<input type="text" class="form-control border-input" id="zipId" value="" disabled placeholder>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label>Fee</label>
													<input type="text" class="form-control border-input" id="feeId" value="" disabled placeholder>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label>Description</label>
													<textarea rows=5 type="text" class="form-control border-input" id="descriptionId" disabled placeholder>    </textarea>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

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
<!-- /MAIN CONTENT -->


<!--   Core JS Files   -->
<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="../assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>

<!-- Paper Dashboard Core JavaScript FOR HAMBURGER KEEP HANDS OFF -->
<script src="../assets/js/paper-dashboard.js"></script>

<!-- NOTIFICATION POPUP/POPULATING TEXT FIELDS -->
<script type="text/javascript">
	$(document).ready(function(){

		$("#user-dropdown-menu li a").click(function(){
			var id = $(this).attr("id");
			//<!-- change get_user to get_event -->
			$.getJSON('get_user.php', { userId : id}, function(response) {
				//<!-- add a line here for each field you need to populate (don't forget to add ids to the fields on the form above) -->
				$("#eventNameId").val(response.firstName);
				$("#speakerId").val(response.lastName);
			});


		});

	});
</script>

<!--
	1. Line 334, change 'userId' to eventId and 'get_user.php' to 'get_event.php'
	2. Add extra lines from 337 onwards
-->

</html>
