<?php
//  This header should be included on every page;
//  it grabs user data from either the database or
//  their session variable
include_once 'dbconfig.php';
require_once 'loginheader.php';
// $user_id = $_SESSION['user_session'];
// $stmt = $DB_con->prepare("SELECT * FROM `User` WHERE idUser=:user_id");
// $stmt->execute(array(":user_id"=>$user_id));
// $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

/*
$conn = new mysqli('lvaitpsitedb.c8yagni7c74b.us-east-2.rds.amazonaws.com', 'awsuser', 'Kutztown', 'lvaitpdb')
or die ('Cannot connect to db');
*/

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(!$user->is_loggedin())
{
    $user->redirect('../index.php');
}

//include '../../event/clsEvents.php';

$nameErr = $dateErr = $timeErr = $streetErr = $cityErr = $stateErr = $zipErr = $feeErr = $descriptionErr = "";

if (isset($_POST['Submit']))
{
    $eventname = $speaker = $date = $time = $street1 = $street2 = $city = $state = $zip = $fee = $description = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty($_POST["eventname"]))
		{
			$nameErr = "* Event name is required";
		}
		else
		{
			$eventname = test_input($_POST["eventname"]);
		}

		if (empty($_POST["speaker"]))
		{
			$speaker = "";
		}
		else
		{
			$speaker = test_input($_POST["speaker"]);
		}

		if (empty($_POST["date"]))
		{
			$dateErr = "* Date is required";
		}
		else
		{
			$date = test_input($_POST["date"]);
		}

		if (empty($_POST["time"]))
		{
			$timeErr = "* Time is required";
		}
		else
		{
			$time = test_input($_POST['time']);
		}

		if (empty($_POST["streetAdd"]))
		{
			$streetErr = "* Street is required";
		}
		else
		{
			$street1 = test_input($_POST["streetAdd"]);
		}

		if (empty($_POST["streetAdd2"]))
		{
			$street2 = "";
		}
		else
		{
			$street2 = test_input($_POST["streetAdd2"]);
		}

		if (empty($_POST["city"]))
		{
			$cityErr = "* City is required";
		}
		else
		{
			$city = test_input($_POST["city"]);
		}

		if (empty($_POST["state"]))
		{
			$stateErr = "* State is required";
		}
		else
		{
			$state = test_input($_POST["state"]);
		}

		if (empty($_POST["zip"]))
		{
			$zipErr = "* Zip is required";
		}
		else
		{
			$zip = test_input($_POST["zip"]);
		}

		if (empty($_POST["date"]))
		{
			$dateErr = "* Date is required";
		}
		else
		{
			$date = test_input($_POST['date']);
		}

		if (empty($_POST["fee"]))
		{
			$feeErr = "* Fee is required";
		}
		else
		{
			$fee = test_input($_POST["fee"]);
		}

		if (empty($_POST["description"]))
		{
			$description = "";
		}
		else
		{
			$description = test_input($_POST["description"]);
		}
	}

    // Create the event...
    $event->createEvent($eventname, $speaker, $date, $time, $street1, $street2, $city, $state, $zip, $fee, $description);

    // Event Team: We commented out the code below.

/*
	$sql = "INSERT INTO Event (name, speaker, date, time, street1, street2, city, state, zip, fee, description)
		VALUES ($eventname, $speaker, $date, $time, $streetAdd, $streetAdd2, $city, $state, $zip, $fee, $description)";

	if ($DB_con->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $DB_con->error;
	}

	//echo "here";
	//$address = $street . " " . $city . " " . $state . " " . $zip;
	//$datearray = preg_split("/[\/-]/", $date);
	//echo $time;
	//$date = $datearray[0] . "-" . $datearray[1] . "-" . $datearray[2] . " " . date("H:i:s", strtotime($time));
	//echo "$address";
	//echo "$date";
	//echo "$time";


	$conn->close();
*/
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
									<h4 class="title">Create Event</h4>
								</div>
								<div class="content">
									<!-- Changed something here -->

									<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>Event Name</label></div>
														<span class="error"><?php echo $nameErr;?></span>
														<input name="eventname" type="text" class="form-control border-input" placeholder="">

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
														<span class="error"><?php echo $dateErr;?></span>
														<input name="date" type="date" class="form-control border-input" placeholder="">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>Time</label></div>
														<span class="error"><?php echo $timeErr;?></span>
														<input name="time" type="time" class="form-control border-input" placeholder="">
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>Street Address</label></div>
														<span class="error"><?php echo $streetErr;?></span>
														<input name="streetAdd" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label>Street Address 2</label>
													<input name="streetAdd2" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<div class="required"><label>City</label></div>
														<span class="error"><?php echo $cityErr;?></span>
														<input name="city" type="text" class="form-control border-input" placeholder="">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<div class="required"><label>State (Ex: PA)</label></div>
														<span class="error"><?php echo $stateErr;?></span>
														<input name="state" type="text" class="form-control border-input" maxlength="2" style="text-transform:uppercase" placeholder="">
												</div>
											</div>
											<div class="col-md-2">
												<div class="form-group">
													<div class="required"><label>Zip</label></div>
													<input name="zip" type="text" class="form-control border-input" maxlength="5" placeholder="">
												</div>
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<div class="required"><label>Fee</label></div>
														<span class="error"><?php echo $feeErr;?></span>
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
												<div class="form-group">
													<p>* Required</p>
												</div>
											</div>
										</div>


										<div class="text-center">
										  <button name="Submit" type="submit" class="btn btn-info btn-fill btn-wd">Create Event</button>
										</div>
										<br>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
<!-- /EVENT FORM -->

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
