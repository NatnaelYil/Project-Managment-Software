
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create New Project</title>

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

            <div class="container-fluid" style="padding-left:20%; padding-right:20%">

                <!-- Page Heading -->
                <div class="row">  <!--Title Section-->
                    <div class="col-lg-6">  <!--Title text-->
                        <h1 class="page-header">New Project Creation</h1>
                    </div>                  <!--closer title text-->
                </div>      <!--close title section-->

                <div class="row">
                    <div class="col-sm-12">  <!--Left half-->
                        <div class="form">
                            <form role="form" method="post" action="cProj.php">
                                <div class="form-group">        <!--Project Title-->
                                    <label>Project Title</label>
                                    <input type="text" name="projTitle" class="form-control" placeholder="Enter name here." size="20" required>
                                    <p class="help-block">Enter the name of the project.</p>
                                </div>  <!--close div class="form-group", Project Title-->

                                <div class="form-group">        <!--Project Description-->
                                    <label>Project Description</label>
                                    <textarea class="form-control" rows="5" style="resize:none" name="projDesc" required></textarea>
                                    <p class="help-block">Please enter a short description of the project in the above textarea.</p>
                                </div>                          <!--Close Proj Desc-->

                                <div class="form-group">        <!--date SHOULD PROB BE CHANGED-->
                                    <label>Start Date:&nbsp</label>
                                    <input type="text" name="startD"/><br/>
                                    <label>End Date:&nbsp&nbsp</label>
                                    <input type="text" name="projEnd" style="margin-left:1px;"/>
									<p class="help-block">Please enter the date as yyyy/mm/dd</p>
                                </div>                          <!--close date-->

                                <div class="form-group">    <!--isActive? - should be last-->
                                    <label>Is the project active?</label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="pActive">Active (YES)
                                    </label>
                                
                                </div>                      <!--close isActive?-->

                                    <div class="alert alert-success" style="margin:20px; display:none">     <!--Success-->
                                        <strong>Well done!</strong> Your form has been succesfully submitted. Please check for correctness.
                                    </div>                                                                  <!--end success-->

                                    <div class="alert alert-danger" style="margin:20px; display:none">    <!--Oh Snap!-->
                                        <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                    </div>                                                                  <!--close Oh Snap!-->

                                <div class="form-buttons" style="text-align:center; margin:30px;">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>      <!--buttons-->


                            </form>
                        </div>      <!--close div class="form"-->
                    </div>      <!--close div class="col-lg-6"-->
                </div>      <!--close div class="row"-->
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

