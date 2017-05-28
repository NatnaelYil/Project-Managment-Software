<?php
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  $projectSql = "SELECT p.projectID as pid, description, title, startDate, endDate FROM Project p JOIN UserProject up ON p.projectID = up.projectID WHERE up.UserID = '$userID'";

  $projectResults = mysqli_query($db,$projectSql);
  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);

    $skillSql = "SELECT s.skillID, s.name FROM Skill s JOIN UserSkill us ON s.skillID = us.skillID WHERE us.UserID = '$userID'";

  $skillResults = mysqli_query($db,$skillSql);
  $skillRows = mysqli_fetch_all($skillResults,MYSQLI_ASSOC);
?>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T Emp Dash</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <link rel='stylesheet' href='css/fullcalendar.min.css' />
	<script src='lib/jquery-3.1.1.min.js'></script>
	<script src='lib/moment.js'></script>
	<script src='lib/fullcalendar.min.js'></script>

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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Hello<b class="caret"></b></a>
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
                        <h1 class="page-header">Employee Dashboard</h1>

                    </div>
                </div>

                <!-- /.row GRAPH!! -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-tasks fa"></i> Current Projects</h3>
                            </div>
                            <div class="panel-body">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row  Project Desc & Skills-->

                <div class="row">
                    <div class="col-lg-8">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Current Projects</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group">

                                  <div class="col-sm-16">
                                      <div class="list-group" id='projectList'>

                                      </div>
                                  </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Personal Skill Set</h3>
                            </div>
                            <div class="panel-body">
                                <div class="list-group" id="skillList">
                                </div>
                              <div class="text-right">
                                  <a href="b.php"> Update Skills<i class="fa fa-arrow-circle-right"></i></a>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- /.row -->

                <!-- /.row  Buttons-->

                <p align=center>
          <a href="b.php">
                    <button type="button" class="btn btn-lg btn-primary">Update Skills</button>
            </a>
                    &nbsp;
					<a href="requestAvailability.php">
                    <button type="button" class="btn btn-lg btn-primary">Request Time Off</button>
						</a>
				</p>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>

<script>
	$(document).ready(function() {

        var skills = [];

        <?php foreach($skillRows as $row){ ?>
            skills.push({
                name: '<?php echo($row['name']);?>',
                url: '<?php echo('https://www.google.com');?>'
            });
        <?php } ?>

        for (var i = 0; i < skills.length; i++){
           $('#skillList').append(
               "<a href='#' class='list-group-item'>" +
                    "<h4 class='list-group-item-heading'>" + skills[i].name + "</h4>" +
                "</a>");

        }

		var projects = [];

        <?php foreach($projectRows as $row){ ?>
            projects.push({
                title: '<?php echo($row['title']);?>',
                start: '<?php echo($row['startDate']);?>',
                end: '<?php echo($row['endDate']);?>',
                description: '<?php echo($row['description']);?>',
                url: '<?php echo("seeProject.php?projectID="); echo($row["pid"]);?>',

            });
        <?php } ?>

        for (var i = 0; i < projects.length; i++){
           $('#projectList').append(
               "<a href='" + projects[i].url + "' class='list-group-item'>" +
                    "<h4 class='list-group-item-heading'>" + projects[i].title + "</h4>" +
                        "<p class='list-group-item-text'>" + projects[i].description + "</p>" +
                "</a>");

        }

		$('#calendar').fullCalendar({
			// put your options and callbacks here
			events: projects,
			eventClick: function(calEvent, jsEvent, view) {
		       	window.location.href = calEvent.url;
		    }
		});

	});
</script>
