<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png"> <!-- working on a new favicon image -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Send Mail</title>

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
    <div class="sidebar" data-background-color="black" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text">
                    LV-AITP Portal
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="user.html">
                        <i class="ti-comments-smiley"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li>
                    <a href="event.php">
                        <i class="ti-calendar"></i>
                        <p>Create Event</p>
                    </a>
                </li>
                <li>
                    <a href="mail.php">
                        <i class="ti-email"></i>
                        <p>Send Mail</p>
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
                    <a class="navbar-brand" href="user.html">LV-AITP Dashboard</a>
                </div> <!-- /navbar-header -->

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../index.php">
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
                                <h4 class="title">Send Mail to LV-AITP Subscribers</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="required"><label>To</label></div>
                                                <input type="text" class="form-control border-input" placeholder="Contact">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="required"><label>Subject</label></div>
                                                <textarea rows=4 type="text" class="form-control border-input" placeholder="Message Content"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                      <button type="submit" class="btn btn-info btn-fill btn-wd">Send Mail</button>
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
                            <a href="http://www.aitptest.weebly.com">
                                LV-AITP Homepage
                            </a>
                        </li>
                        <li>
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

</html>
