<?php 
  include("config.php");
  session_start();

  $projectID = $_GET['projectID'];

  $projectSql = "SELECT p.projectID as pid, isActive, description, title, startDate, endDate FROM Project p WHERE p.projectID = '$projectID'";

  $projectResults = mysqli_query($db,$projectSql);
  $projectRows = mysqli_fetch_all($projectResults,MYSQLI_ASSOC);
  
  $userProjectSql = "SELECT u.userName, u.userID FROM Project p JOIN UserProject up ON p.projectID = up.projectID JOIN User u ON up.userID = u.userID WHERE up.projectID = '$projectID'";

  $userProjectResults = mysqli_query($db,$userProjectSql);
  $userProjectRows = mysqli_fetch_all($userProjectResults,MYSQLI_ASSOC);
  
  $userSql = "SELECT * from User WHERE userTypeID = 'e7e02872-a87b-11e6-baa0-5254005b5605'";

  $userResults = mysqli_query($db,$userSql);
  $userRows = mysqli_fetch_all($userResults,MYSQLI_ASSOC);
  

?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>m_T Edit Project</title>

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
                        <h1 id="projecttitle" class="page-header"> </h1>

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
								<p id="description">
								</p>
							</div>
						  <form>
							<textarea id="newdesc" name="description" cols="90" rows="10" required="required"></textarea>
                          </form>
						  	<div>
								<button id="submit" type="button" onClick="finish()">Submit</button>
							</div>

                      </div>
                    </div>
			
					
					
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Assign Employees</h3>
                            </div>
                            <div class="panel-body">																																																																																																																																																																																																																							
							<ul id="assignedEmp">
								
								
							</ul>
							
							<select id="empSelect" onchange="selectIngredient(this);">
								
							</select>
							
							</div>
								<input id="activeCheckbox" type="checkbox" name="pActive"/> Is Active
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
	var userData = [];

	$(document).ready(function(){
			
            var project = {
                title: '<?php echo($projectRows[0]['title']);?>',
                start: '<?php echo($projectRows[0]['startDate']);?>',
                end: '<?php echo($projectRows[0]['endDate']);?>',
                description: '<?php echo($projectRows[0]['description']);?>',
				isActive: '<?php echo($projectRows[0]['isActive']);?>'
            };

		var userProjects = [];
        
        <?php foreach($userProjectRows as $row){ ?>
            userProjects.push({
                userName: '<?php echo($row['userName']);?>',
                userID: '<?php echo($row['userID']);?>'
            });
        <?php } ?>			

        for (var i = 0; i < userProjects.length; i++){
			userData.push(userProjects[i].userID);
           $('#assignedEmp').append(
		   "<li onclick='removeThis(this);'>" +
			"<input type='hidden' name='ingredients[]' value='" + userProjects[i].userID + "' />" + userProjects[i].userName + "</li>"
			);

        }
		
		var employees = [];
        
        <?php foreach($userRows as $row){ ?>
            employees.push({
                name: '<?php echo($row['userName']);?>',
                id: '<?php echo($row['userID']);?>'
            });
        <?php } ?>
	
        for (var i = 0; i < employees.length; i++){
           $('#empSelect').append(
               			"<option value='" + employees[i].id + "' >" +
						 employees[i].name +"</option>");

        }
			
		
			$("#description").text(project.description);
			$("#newdesc").text(project.description);
			$("#projecttitle").text(project.title);
			$("#assignedEmp").text(userProjects.userID);
			
			if(project.isActive == '1')
			{
				$("#activeCheckbox").prop( "checked", true );
			}
			else
			{
				$("#activeCheckbox").prop( "checked", false );
			}
	});


	function removeThis(obj){
	
		obj.parentNode.removeChild(obj);
		userData =[];
		$("#assignedEmp li input").each(function(index){
			userData.push($(this).val());
		});
	}
	function selectIngredient(select)
	{
		var option = select.options[select.selectedIndex];
		var ul = select.parentNode.getElementsByTagName('ul')[0];
     
		var choices = ul.getElementsByTagName('input');
		for (var i = 0; i < choices.length; i++)
			if (choices[i].value == option.value)
			return;
     
		var li = document.createElement('li');
		var input = document.createElement('input');
		var text = document.createTextNode(option.firstChild.data);
     
		input.type = 'hidden';
		input.name = 'ingredients[]';
		input.value = option.value;

		li.appendChild(input);
		li.appendChild(text);
		li.setAttribute('onclick', 'removeThis(this);');     
    
		ul.appendChild(li);
		
		userData =[];
		$("#assignedEmp li input").each(function(index){
			userData.push($(this).val());
		});
	}

	
	
	function finish()
	{
		var descriptionButt = $("#newdesc").val();
		
		var nameVal = $("#nameSelect").val();
		var jobTitleVal = $("#jobTitleSelect").val();
		console.log(userData);
		$.ajax({ url: 'updateProject.php',
         data: {isActive: $("#activeCheckbox").prop( "checked"), projectTitle: $("#projecttitle").text(), description: descriptionButt, userIDs: userData, projectID:'<?php echo ($projectID); ?>'},
         type: 'post',
         success: function(output) { console.log(output);}                  
		});
		
		location.reload();
	}
</script>

