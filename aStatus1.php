<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T Account Status</title>

    <!-- script for user status -->
    <script>
    function changeRecord()
    {
    	document.editSForm.action='changeAS.php';
    	document.editSForm.submit();
    }
    </script>

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
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
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
                        <h1 class="page-header"> Activate or Deactivate Accounts</h1>

                    </div>
                </div>


                <!-- /.row  both search and list -->

                <div class="row">

                  <!-- /.row  first column 'search'->

                                      <div class="col-lg-5">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h3 class="panel-title"> Search User Account</h3>
                                              </div>
                                              <div class="panel-body">
                                                  <div class="table-responsive">

                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Job Title</label>
                                                        <select class="form-control">
                                                            <option>All Job Titles</option>
                                                            <option>Business Consultant</option>
                                                            <option>Database Administrator</option>
                                                            <option>Field Manager</option>
                                                            <option>Programmer</option>
                                                            <option>Project Manager</option>
                                                            <option>Tester</option>
                                                        </select>
                                                    </div>

                                                    <!- /.row  Button->

                                                    <p>
                                                        <button type="button" class="btn btn-sm btn-primary">Search</button>
                                                    </p>

                                                  </div>

                                              </div>
                                          </div>
                                      </div>



                    <!- /.row  second colomn 'list'-->

                    <div class="col-lg-7">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Current Account Status</h3>
                            </div>
                            <div class="panel-body">

                              <!-- /.row  second colomn 'list'-->
                              <div class="col-lg-12">
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-hover table-striped">
                                        <form action='changeAS.php' name='editSForm' method='post'>
                                          <!--div align='center'>
                                            <button type="button" class="btn btn-sm btn-primary" action=''>Switch "Active" Status</button>
                                          </div-->
                                       <?php
                                       include("config.php");
									   
									   $projectSql = "SELECT userID, name, isActive FROM User";

									  $projectResults = mysqli_query($db,$projectSql);
									  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);

                                       echo "<table class='table table-bordered table-hover table-striped'>";
                                       echo "<th></th><th>Name</th><th>Current Status</th>";

										foreach($projectRows as $row) {
											echo "<tr>";
											echo "<td><input type='radio' name='userID' value='".$row['userID']."'></td>";
											echo "<td>".$row["name"]."</td>";
											echo "<td>".$row["isActive"]."</td>";
											echo "</tr>";
										}
                                       
                                       echo "</table>";                              
                                       ?>
                                        <div align='center'>
                                            <input type="submit" class="btn btn-sm btn-primary" value='Change Record'>
                                          </div>
                                        </form>
                                      </table>
                                  </div>
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>

