<?php
//This header should be included on every page;
//  it grabs user data from either the database or
//  their session variable
require 'loginheader.php';

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

    <title>Add Sponsor</title>

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
                <li>
                    <a href="create_event.php">
                        <i class="ti-calendar"></i>
                        <p>Create Event</p>
                    </a>
                </li>
                <li class="active">
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

<!-- MAIL FORM -->

                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Sponsor</h4>
                            </div>
                            <div class="content">
                                <form enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="required"><label>Sponsor Name</label></div>
                                                <input type="text" name="sponsor" class="form-control border-input" placeholder="Company Name" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="required"><label>Link to Site</label></div>
                                                <input type="text" name="link" class="form-control border-input" placeholder="Company Website" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="required"><label>Image Upload</label></div>
                                            </div>
                                        </div>
                                    </div>

                    <?php
                    //After submit button is pressed
                    if(isset($_POST["submit"])) {
                        $target_dir = "../slick/sponsor_imgs/";
                        $target_file = $target_dir . basename($_FILES["input-dim-1"]["name"]);

                        if ($_FILES['input-dim-1']['error'] > 0) {
                            echo "Error: " . $_FILES['input-dim-1']['error'] . "<br />";
                        } else {
                            // Ensure the file at least has an image extension
                            $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
                            // Get extension of the uploaded file
                            $fileExtension = strrchr($_FILES['input-dim-1']['name'], ".");
                            // check if file extension is on the list of allowed ones
                            if (in_array($fileExtension, $validExtensions)) {
                                // we are renaming the file so we can upload files with the same name
                                // we simply put current timestamp in fron of the file name
                                if (move_uploaded_file($_FILES["input-dim-1"]["tmp_name"], $target_file)) {
                                    echo 'File ' . $newName. ' succesfully copied';
                                } else { echo "Something went wrong."; }
                            } else {
                                echo 'You must upload an image...';
                            }
                            // Now to write the metadata to file
                            $file = '../slick/sponsor_imgs.txt'; // This file here, to be exact

                            //Copy current contents to $txt_file
                            $txt_file    = file_get_contents($file);

                            // Append to $txt_file the new metadata in format: "imagename.jpg^This Is A Sponsor"
                            $txt_file .= "\n" . basename($_FILES["input-dim-1"]["name"]) . "^" . $_POST["sponsor"] . "^" . $_POST["link"];

                            // Write the contents back to the file
                            file_put_contents($file, $txt_file);
                        }
                    }
                    ?>

                    <!-- IMAGE UPLOAD: MINIMUM IMAGE DIMENSIONS -->
                    <!--<div class="file-loading">
                        <input id="input-dim-1" name="input-dim-1[]" multiple type="file" accept="image/*">
                        <output id="filesInfo"></output>
                    </div>-->
                    <div class="file-loading">
                        <label for="input-dim-1">Select a File to Upload</label><br />
                        <input type="file" name="input-dim-1" id="input-dim-1" required />
                    </div>
                    <!--<script>
                        $("#input-dim-1").fileinput({
                        uploadUrl: "/design_updated_dashboard/login/images/sponsors/",
                        allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
                        minImageWidth: 50,
                        minImageHeight: 50
                        });
                    </script>-->
                                    <br>
                                    <div class="text-center">
                                      <button type="submit" name="submit" class="btn btn-info btn-fill btn-wd">Submit</button>
                                    </div>
                                </form>
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
    <script src="../assets/js/bootstrap-notify.js"></script>

    <!-- Paper Dashboard Core JavaScript FOR HAMBURGER KEEP HANDS OFF -->
    <script src="../assets/js/paper-dashboard.js"></script>

</html>
