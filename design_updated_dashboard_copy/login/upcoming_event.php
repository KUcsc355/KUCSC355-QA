<?php 
require "loginheader.php";
if(!$user->is_loggedin())
{
    $user->redirect('../index.php');
}

include '../../event/clsEvents.php';

$eventobject = new Events();
$eventRegister = new Events();
$eventinfo = $eventobject->getAllEventInfo();
$idarray = array();
foreach ($eventinfo as $event) {
	array_push($idarray, $event["eventID"]);
}

/*if(isset($_POST['Submit']))
{
	$eventid = trim($_POST['eventid']);
	$userid = $user_id;
	print_r($idarray);
	echo $userid;
	
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>View Events</title>

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
	
	<!-- Responsive Table CSS -->
	<link href="../assets/css/event_main.css" rel="stylesheet" media="screen"/>

</head>
<body>

<!-- Center Content -->
    <div class="container full">
        <div class="row">
                <h3>Upcoming Event</h3>
                    <strong>Insert upcoming event here</strong>
                    <br>
                <br><br>
            </div>

<!-- MAIL FORM -->
<!--<div class="content">
			<div class="container full">
            <div class = "card">
			
                <div class = "head">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped">
                            <thead>
									<th><font size = 5>Name</font></th>
									<th><font size = 5>Date</font></th>
									<th><font size = 5>Location</font></th>
                                </thead>
								<tbody>-->
					
					    <?php
					    //include '../../event/clsEvents.php';
					    //$eventobject = new Events();
					    //$eventinfo = $eventobject->getAllEventInfo();
					
						
					    $idarray = array();
						$counter = 0;						
				            foreach ($eventinfo as $event) {
					    	   //echo "<tr><td name=\"eventid\" id=\"eventid\" hidden>" . $event["eventID"] . "</td>"; 
						   $eventID = $event["eventID"];
						   
						   /*echo "<form class='form-signupevent' id='signupevent' name='signupevent' method='post'>";
						   echo "<td>" . $event["name"] . "</td>";
						   echo "<td>" . $event["street1"] . "</td>";
						   echo "<td>" . preg_split("/[\s]/", $event["date"])[0] . "</td>";		
						   echo "<td></td></tr>";		
						   //echo "<td><button name= 'Submit' value = '{$event['eventID']}' id=\"Submit\" type=\"submit\">signup</button></td></tr>";
						   echo ++$counter;*/
		

						   echo "</form>";
							}

							 if(isset($_POST['Submit'])){
							  $userID = $user_id;
							  $value = $_POST['Submit'];
							  echo " this is the value  " . $value;
							  echo "event ID is " . $eventID . "and the user ID is " . $userID;
							  $eventRegister->register($value, $userID);
							  
							  
							}
						    
						
							$counter++;
						   
					    
					    
					    //print_r($idarray);

					    ?>                                 
                                    </tbody>
                                </table>

                            </div>
                        </div>
			
                    </div>

<!-- /MAIL FORM -->

    </div>
</div>

</body>

    <!--   Core JS Files   -->
    <script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="../assets/js/bootstrap-checkbox-radio.js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>

</html>