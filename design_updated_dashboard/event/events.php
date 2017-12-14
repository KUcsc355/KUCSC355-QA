<?php

require_once("clsEvents.php");

function getTime($time) {
    /**
     * Get the time in an array where
     * [0] = hour, [1] = mininute meridiem
     */
    $arr = explode(':', $time);
    $hour = $arr[0];
    $min = substr($arr[1], 0, 2);

    if (strpos($time, 'AM') !== false && $hour == 12) {
        $hour = 0;
    } else if (strpos($time, 'PM') !== false && $hour < 12) {
        $hour += 12;
    }

    return $hour . ':' . $min . ':00';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Events</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./assets/css/styles.css">

  <!-- Bootstrap -->
  <!-- https://cdnjs.com/libraries/bootstrap-timepicker -->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="./assets/css/bootstrap-datepicker3.min.css">
  <link rel="stylesheet" href="./assets/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="./assets/css/main.css">
  <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/bootstrap.min.js"></script>
  <script src="./assets/js/bootstrap-select.min.js"></script>
  <script src="./assets/js/bootstrap-datepicker.min.js"></script>
  <script src="./assets/js/bootstrap-timepicker.min.js"></script>
</head>

<body>
  <!-- Top -->
  <div class="topMenu">
    <div class="logo"></div>
    <div class="menu">
      <a href="http://aitptest.weebly.com/">
        <div class="option">WELCOME</div>
      </a>
      <a href="http://aitptest.weebly.com/about.html">
        <div class="option">ABOUT</div>
      </a>
      <a>
        <div class="option active">EVENTS</div>
      </a>
      <a href="http://aitptest.weebly.com/contributors.html">
        <div class="option">CONTRIBUTORS</div>
      </a>
      <a href="http://aitptest.weebly.com/leadership.html">
        <div class="option">LEADERSHIP</div>
      </a>
    </div>
  </div>
  <!-- Navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Logo -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">
          Events
          <!-- <img src="./assets/img/logo.png" alt="Logo"> -->
        </a>
      </div>

      <!-- Navbar Items -->

      <!-- Right Content -->
      <div id="main-navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="#" data-toggle="modal" data-target="#event-modal">
                Add Event
              </a>
            </li>

        </ul>
      </div>
    </div>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="event-modal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Event</h4>
        </div>
        <div class="modal-body">
          <form id="addEvent" method="post">
            <!-- Name -->
            <div class="input-group">
              <span class="input-group-addon">
                <label for="eventName">Name:</label>
  			  </span>
  			  <input class="form-control" type="text" name="eventName" />
  			</div>
            <!-- Description -->
            <div class="input-group">
			  <span class="input-group-addon">
			    <label for="eventDesc">Description:</label>
			  </span>
			  <textarea class="form-control" name="eventDesc"></textarea>
			</div>
            <!-- Date -->
            <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
              <span class="input-group-addon">
                <label for="eventDate">Date:</label>
  			  </span>
  			  <input class="form-control" type="text" name="eventDate" readonly/>
              <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
  			</div>
            <!-- Time -->
            <div class="input-group bootstrap-timepicker timepicker">
              <span class="input-group-addon">
                <label for="eventTime">Time:</label>
  			  </span>
  			  <input class="form-control" id="timepicker" type="text" name="eventTime" readonly/>
              <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
  			</div>
            <script type="text/javascript">
                $('#timepicker').timepicker();
            </script>
            <!-- Place -->
            <div class="input-group">
			  <span class="input-group-addon">
			    <label for="eventAddress">Location:</label>
			  </span>
			  <input class="form-control" type="text" name="eventAddress" />
			</div>
            <!-- Speakers -->
            <div class="input-group">
			  <span class="input-group-addon">
			    <label for="eventSpeakers">Speakers:</label>
			  </span>
			  <input class="form-control" type="text" name="eventSpeakers" />
			</div>
          </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="document.getElementById('addEvent').submit();">ADD </button>
        </div>
      </div>
    </div>
  </div>

  <!-- More PHP here -->

  <?
    $event = new Events();
    /**
     * This check needs a miracle. Will fix later.
     */
    if (trim($_POST['eventName']) !== "" && trim($_POST['eventDesc']) !== "" && isset($_POST['eventName'], $_POST['eventDesc'], $_POST['eventDate'], $_POST['eventTime'], $_POST['eventAddress'])) {
        $eventName      = $_POST['eventName'];
        $eventSpeakers  = isset($_POST['eventSpeakers']) ? $_POST['eventSpeakers'] : "";
        $eventDesc      = $_POST['eventDesc'];
        $eventDate      = $_POST['eventDate'];
        $eventTime      = getTime($_POST['eventTime']);
        $eventFee       = 0;
        $eventAddress   = $_POST['eventAddress'];

        $event->createEvent($eventName, $eventSpeakers, $eventAddress, $eventDate, $eventTime, $eventFee, $eventDesc);
    }
  ?>

  <!-- Center Content -->
  <div class="container full" style="margin-top:80px;">
    <div class="row">
      <div class="spacer"></div>
      <div class="row">
        <div class="well">

          <strong>Note:</strong>
          Unless stated otherwise, all AITP LV meetings are opened to the
          public. RSVP is required.
        </div>
      </div>
      <?
        for ($i = 0; $i < $event->getTotalEvents(); ++$i) {
            $eName      = $event->retrieveEvent($i, "name");
            $eSpeakers  = $event->retrieveEvent($i, "speaker");
            $eAddress   = $event->retrieveEvent($i, "address");
            $eDate      = $event->retrieveEvent($i, "date");
            $eTime      = $event->retrieveEvent($i, "time");
            $eDesc      = $event->retrieveEvent($i, "description");
      ?>
      <div class="card">
          <div class="head">
            <div class="title"><?=$eName?></div>
            <div class="date"><?=$eDate?> / <?=$eTime?></div>
          </div>
          <div class="body"><?=$eDesc?></div>
          <div class="footer">
            <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i><strong>Location:</strong> <?=$eAddress?></div>
            <div class="speaker"><i class="fa fa-comment" aria-hidden="true"></i><? if (!empty($eSpeakers)) echo "<strong>Speaker:</strong> $eSpeakers"?></div>
          </div>
      </div>
      <?
        }
      ?>
    </div>
  </div>
</body>
</html>
