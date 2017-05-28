<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  $trackSql = "SELECT u.userID as uid, u.userName as uuname FROM User u JOIN FieldManagerUser fu  ON u.userID = fu.userID WHERE fu.fieldManagerID = '$userID'";

  $projectResults = mysqli_query($db,$trackSql);
  $fmRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);

?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T FM Dash</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

<script src='lib/jquery-3.1.1.min.js'></script>
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="redirectToDashboard.php"><i>manage_THIS</i></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Hello <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="redirectToDashboard.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="notificationList.php"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="redirectToDashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="proS.php"><i class="fa fa-fw fa-wrench"></i> Projects</a>
                    </li>
                    <li>
                        <a href="direct.php"><i class="fa fa-fw fa-globe"></i> Directory</a>
                    </li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Field Manager Dashboard</h1>

                    </div>
                </div>


                <!-- /.row  Buttons-->
          <div class="row">
            <div class="col-lg-4">

                <!--p>
                    <button type="button" onclick="search()" class="btn btn-lg btn-primary">Track Subordinates</button>
                </p-->
                <p>
                    <a href="notificationList.php" class="btn btn-lg btn-primary" role="button">Employee Project Requests</a>
                </p>
                <p>
                    <a href="notificationList.php" class="btn btn-lg btn-primary" role="button">Subordinates Availability Requests</a>
                </p>
            </div>

                <!-- /.row  Pie->


                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                                <div class="text-right">
                                    <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div-->

            <!-- /.row  second colomn 'list'-->

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Active Subordinates</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                              <div class="list-group" id="skillList">
                              </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

          </div>

            <!--- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->



    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>

<script>
	$(document).ready(function() {

        var fmUsers = [];

        <?php foreach($fmRows as $row){ ?>
            fmUsers.push({
                name: '<?php echo($row['uuname']);?>',
                url: '<?php echo('https://www.google.com');?>'
            });
        <?php } ?>

        for (var i = 0; i < fmUsers.length; i++){

           $('#skillList').append(
               "<a href='#' class='list-group-item'>" +
                    "<h4 class='list-group-item-heading'>" + fmUsers[i].name + "</h4>" +
                "</a>");

        }

	});
</script>
