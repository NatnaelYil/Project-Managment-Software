<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T Create User</title>

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
                        <h1 class="page-header"> Create New User</h1>

                    </div>
                </div>


                <!-- /.row  both search and list -->

                <div class="row">

                  <!-- /.row  first column 'create'-->

                                      <div class="col-lg-6">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h3 class="panel-title"> Enter New User Information</h3>
                                              </div>
                                              <div class="panel-body">
<form action='addUser.php' method='post'>
                                                  <div class="table-responsive">

                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input class="form-control" type='text' name='fName'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input class="form-control" type='text' name='lName'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input class="form-control" type='text' name='uName'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input class="form-control" type='text' name='pWord'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Job Title</label>
                                                        <select class="form-control" name='job'>
                                                            <option selected disabled hidden value>--Select Job Title--</option>
                                                            <option value="1">Business Consultant</option>
                                                            <option value="2">Database Administrator</option>
                                                            <!--option value="3">Field Manager</option-->
                                                            <option value="4">Programmer</option>
                                                            <option value="5">Project Manager</option>
                                                            <option value="6">Tester</option>
                                                        </select>
                                                    </div>

                                                    <!-- /.row  Button-->

                                                    <p>
                                                        <input type="submit" class="btn btn-sm btn-primary" value="Create User"></button>
                                                    </p>

                                                  </div>
                                                </form>
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
