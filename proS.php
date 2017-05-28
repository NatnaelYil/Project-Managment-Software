<?php 
  include("config.php");
  session_start();

  $userID = $_SESSION['userID'];

  $projectSql = "SELECT p.projectID as pid, description, title, startDate, endDate FROM Project p";

  $projectResults = mysqli_query($db,$projectSql);
  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T Project Search</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">
	<script src='lib/jquery-3.1.1.min.js'></script>
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
                    <li>
                        <a href="redirectToDashboard.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
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
                        <h1 class="page-header"> Project Search</h1>

                    </div>
                </div>


                <!-- /.row  both search and list -->

                <div class="row">

                  <!-- /.row  first column 'search'-->

                                      <div class="col-lg-5">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h3 class="panel-title"> Search by Name</h3>
                                              </div>
                                              <div class="panel-body">
                                                  <div class="table-responsive">

                                                    <div class="form-group">
                                                        <input id="nameSelect" class="form-control">
                                                    </div>

                                                    <!-- /.row  Button-->

                                                    <p>
                                                        <button type="button" onclick="search()" class="btn btn-sm btn-primary">Search</button>
                                                    </p>

                                                  </div>

                                              </div>
                                          </div>
                                      </div>



                    <!-- /.row  second colomn 'list'-->

                    <div class="col-lg-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Open Projects</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">

                                        <tbody id="projectTable">

                                        </tbody>
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

    <!-- jQuery -->

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
        
		var projects = [];

        <?php foreach($projectRows as $row){ ?>
		
            projects.push({
                title: '<?php echo($row['title']);?>',
                start: '<?php echo($row['startDate']);?>',
                end: '<?php echo($row['endDate']);?>',
                description: '<?php echo($row['description']);?>',
                url: '<?php echo("seeProject.php?projectID="); echo($row["pid"]);?>'
            });
        <?php } ?>
	

        for (var i = 0; i < projects.length; i++){

           $('#projectTable').append(
                    "<tr><td> <a href='" + projects[i].url + "' class='list-group-item'>" + projects[i].title +
                "</a></td></tr>");

        }

	});
	
	function search()
	{
		console.log("yes");
		var nameVal = $("#nameSelect").val();
		
		$.ajax({ url: 'searchProject.php',
         data: {name: nameVal},
         type: 'post',
         success: function(output) {
                      var result = JSON.parse(output);
					
					  $("#projectTable").empty();
					  for(var i = 0; i < result.length; i++){
						  
						  $("#projectTable").append("<tr><td> <a href='seeProject.php?projectID=" + result[i]["projectID"] + "' class='list-group-item'>" + result[i]["title"] +
                "</a></td></tr>")
					  }
                  }
		});
	}
</script>
