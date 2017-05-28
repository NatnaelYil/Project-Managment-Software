<?php
  include("config.php");
  session_start();

  $projectID = $_GET['projectID'];
  $canEdit = $_SESSION['canEdit'];

  $projectSql = "SELECT p.projectID as pid, description, title, startDate, endDate FROM Project p  WHERE p.projectID = '$projectID'";

  $projectResults = mysqli_query($db,$projectSql);
  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);

  $userProjectSql = "SELECT u.userName, u.userID FROM Project p JOIN UserProject up ON p.projectID = up.projectID JOIN User u ON up.userID = u.userID WHERE up.projectID = '$projectID'";

  $userProjectResults = mysqli_query($db,$userProjectSql);
  $userProjectRows = mysqli_fetch_all($userProjectResults,MYSQLI_ASSOC);

?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T See Project</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
	<script src='lib/jquery-3.1.1.min.js'></script>
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
                <a class="navbar-brand" href="index.html"><i>manage_THIS</i></a>
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
                    <li>
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
                        <h1 id="projecttitle" class="page-header"></h1>

                    </div>
                </div>



                <!-- /.row  Project Desc & Skills-->

                <div class="row">
                    <div class="col-lg-8">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">Project Description</h3>
                          </div>
                          <div id="desc" class="panel-body">
                              <p id="description"></p>
                          </div>

					  </div>


				<div class="text-left">
                    <a id="eplink"> Edit Project <i class="fa fa-arrow-circle-right"></i></a>
                </div>


                    </div>


                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Assigned Employees</h3>
                            </div>
                            <div class="panel-body">
                                <div id="assEmp" class="table-responsive">
                                    <table id="assignedEmp" class="table table-bordered table-hover table-striped">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

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
	$(document).ready(function(){

            var project = {
                title: '<?php echo($projectRows[0]['title']);?>',
                start: '<?php echo($projectRows[0]['startDate']);?>',
                end: '<?php echo($projectRows[0]['endDate']);?>',
                description: '<?php echo($projectRows[0]['description']);?>',
				url: '<?php echo("editProject.php?projectID="); echo($projectID);?>'

            };

		var userProjects = [];

        <?php foreach($userProjectRows as $row){ ?>
            userProjects.push({
                userName: '<?php echo($row['userName']);?>',
                userID: '<?php echo($row['userID']);?>'
            });
        <?php } ?>

        for (var i = 0; i < userProjects.length; i++){
           $('#assignedEmp').append(
               "<tr>" +
                    "<td class='list-group-item-heading' style='padding-left:10;'>" + userProjects[i].userName + "</td>" +
                "</tr>");

        }

			$("#eplink").prop("href", project.url);
			$("#description").text(project.description);
			$("#projecttitle").text(project.title);
			$("#assignedEmp").text(userProjects.userID);
      <?php if($canEdit != "1"){ ?>
          $("#eplink").css("display", "none");
      <?php } ?>
	});
</script>
