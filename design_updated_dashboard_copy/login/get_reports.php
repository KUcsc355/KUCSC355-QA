<?php
include_once 'dbconfig.php';

require "loginheader.php";
if(!$user->is_loggedin()||$userRow['priveledge']!=2)
{
    $user->redirect('../index.php');
}

if (isset($_POST['btn-edit'])) {
    // Update to provide error checking...
    $name = $_POST['eventName'];
    $speaker = $_POST['speaker'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $street1 = $_POST['location'];
    $street2 = ""; // Need a field for this...
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $fee = $_POST['fee'];
    $description = $_POST['description'];
    //echo $name.$speaker.$date.$time.$street1.$street2.$city.$state.$zip.$fee.$description;
    $event->updateEvent($name, $speaker, $date, $time, $street1, $street2, $city, $state, $zip, $fee, $description);
}

if (isset($_POST['btn-delete'], $_POST['eventName'])) {
    $event->deleteEvent($_POST['eventName']);
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

	<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var button = $('.form-control');
            $(button).prop('disabled', true);

            $('.click').click(function() {
                if ($(button).prop('disabled')) {
                    $(button).prop('disabled', false);
                    $('#btn-edit').prop('value', 'Save');
                    $('#btn-delete').prop('type', 'button');
                    $('#eventNameId').prop('readonly', true);
                    $('#headCount').prop('readonly', true);
                } else {
                    //$(button).prop('disabled', true);
                    $('#btn-edit').prop('value', 'Edit Event');
                    $('.btn').prop('type', 'submit');
                    $('.btn').prop('formmethod', 'submit');
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

					<li>
						<a href="user.php">
							<i class="ti-user"></i>
							<p><?php echo $userRow['fName'] . " " . $userRow['lName']; ?></p>
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
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-8 col-md-7">
						<div class="card">
							<div class="header">
								<h4 class="title">Get Reports</h4>
							</div>
							</br>

							<div class="dropdown" style="margin-left: 15px">
								<button class="btn btn-info btn-fill btn-wd" id="eventName" name="eventNames" type="button" data-toggle="dropdown">Choose Event
								<span class="caret"></span></button>
								<ul class="dropdown-menu" id="user-dropdown-menu" style='text-align: center; vertical-align: middle'>
									<!-- GOOD DROPDOWN MENU HERE!! -->
									<?php
										$conn = new mysqli('lvaitpsitedb.c8yagni7c74b.us-east-2.rds.amazonaws.com', 'awsuser', 'Kutztown', 'lvaitpdb')
										or die ('Cannot connect to db');

										$result = $conn->query("SELECT eventID, name FROM Event ORDER BY date DESC LIMIT 10");

										while ($row = $result->fetch_assoc())
										{
											unset($eventName);
											unset($eventID);
											$eventName = $row['name'];
											$eventID = $row['eventID'];
											echo '<li><a href="#" id="' .$eventID. '">' .$eventName. '</a></li>';
										}

									?>
								</ul>
							</div>

							<div class="content">
								<form method="post">
									<h5 class="title">Details</h5>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>Event Name</label>
												<input type="text" class="form-control border-input" id="eventNameId" name="eventName" value="" disabled placeholder>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>Speaker(s)</label>
												<input type="text" class="form-control border-input" id="speakerId" name="speaker" value="" disabled placeholder>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>Date</label>
												<input type="text" class="form-control border-input" id="dateId" name="date" value="" disabled placeholder>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>Head Count</label>
												<input type="text" class="form-control border-input" id="headCount" name="headCount" value="" disabled placeholder>
											</div>
										</div>
									</div>
									<h5 class="title">Location</h5>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Street Address</label>
												<input type="text" class="form-control border-input" id="locationId" name="location" value="" disabled placeholder>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>City</label>
												<input type="text" class="form-control border-input" id="cityId" name="city" value="" disabled placeholder>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label>Zip</label>
												<input type="text" class="form-control border-input" id="zipId" name="zip" value="" disabled placeholder>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label>Fee</label>
												<input type="text" class="form-control border-input" id="feeId" name="fee" value="" disabled placeholder>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Description</label>
												<textarea rows=5 type="text" class="form-control border-input" id="descriptionId" name="description" disabled placeholder>    </textarea>
											</div>
										</div>
									</div>
								<div class="text-center"><div class="click">
                                    <input id='btn-edit' name='btn-edit' value='Edit Event' class="btn btn-info btn-fill btn-wd" type='button'></input>
                                    <input id='btn-delete' name='btn-delete' value='Delete Event' class="btn btn-info btn-fill btn-wd" type='hidden'></input></div>
                                </div>
								</form><br>
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

<!-- DEIONDRE TEST (MERGE BELOW LATER) -->
<!-- Changes the button dropdown text in respect to the selected event -->
<script type="text/javascript">
    $('#user-dropdown-menu li').click(function() {
        $('#eventName').html($(this).find('a').html());
    });
</script>

<!-- NOTIFICATION POPUP/POPULATING TEXT FIELDS -->
<script type="text/javascript">

		$("#user-dropdown-menu li a").click(function() {
			var id = $(this).attr("id");
			<!-- change get_user to get_event -->
			$.getJSON('get_event.php', { idEvent : id }, function(response) {
				<!-- add a line here for each field you need to populate (do not forget to add ids to the fields on the form above) -->
				$("#eventNameId").val(response.eventName);
				$("#speakerId").val(response.speakerName);
				$("#dateId").val(response.date);
				$("#locationId").val(response.street);
				$("#cityId").val(response.city);
				$("#zipId").val(response.zip);
				$("#feeId").val(response.fee);
				$("#descriptionId").val(response.description);
			});
		});
</script>

</html>
