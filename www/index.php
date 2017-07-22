<?php
    require_once('includes/bootstrap.inc');

    $db = init_db();

    $res = $db->query('SELECT SENSOR_TYPE,ID,DESCRIPTION FROM SENSORS')->fetchAll(PDO::FETCH_ASSOC);

    $sensors=[];
    //TODO: maybe PDO can help make an SENSOR_TYPE-keyed array without this
    foreach($res as $k=>$v){
            $sensors[$v['SENSOR_TYPE']][] = $v;
    }

    foreach($sensors as $k=>$s){
        //get measurements
        $q = $db->prepare('SELECT mtime,VALUE FROM MEASUREMENTS WHERE SENSOR_ID=:sid ORDER BY mtime DESC LIMIT 100'); //TODO: make horizon tweakale
        $q->execute(array(':sid' => $s[0]['ID'] ) );

        $sensors[$k][0]['DATA'][] = $q->fetchAll(PDO::FETCH_ASSOC);
    }

    //print_r($sensors);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hydroponix</title>

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
                <a class="navbar-brand" href="index.php">Hydroponix</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                            <li>
                                <a href="#">Dropdown Item</a>
                            </li>
                        </ul>
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
                        <h1 class="page-header">
                            Dashboard
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

		<!--
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                        </div>
                    </div>
                </div>
		-->
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-sun-o fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
						<?php
                                                    //FIXME: Loop over the $sensors data struct and dynamically add those columns depending on the sensors found
                                                    echo ($sensors['Temperature'][0]['DATA'][0][0]['VALUE']?$sensors['Temperature'][0]['DATA'][0][0]['VALUE']:'--');
						?>
					</div>
                                        <div>&deg;Celsius</div>
                                    </div>
                                </div>
                            </div>
                            <a id="viewTemperature" href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tint fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                                //FIXME: Loop over the $sensors data struct and dynamically add those columns depending on the sensors found
                                                echo $sensors['Humidity'][0]['DATA'][0][0]['VALUE'];
                                            ?>
					</div>
                                        <div>% Humidity</div>
                                    </div>
                                </div>
                            </div>
                            <a id="viewHumidity" href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-flask fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                                //FIXME: Loop over the $sensors data struct and dynamically add those columns depending on the sensors found
                                                echo ($sensors['PH'][0]['DATA'][0][0]['VALUE']?$sensors['PH'][0]['DATA'][0][0]['VALUE']:'--');
                                            ?>
					</div>
                                        <div>pH</div>
                                    </div>
                                </div>
                            </div>
                            <a id="viewPh" href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-bolt fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                            <?php
                                                //FIXME: Loop over the $sensors data struct and dynamically add those columns depending on the sensors found
                                                echo ($sensors['EC'][0]['DATA'][0][0]['VALUE']?$sensors['EC'][0]['DATA'][0][0]['VALUE']:'--');
                                            ?>
					</div>
                                        <div>EC</div>
                                    </div>
                                </div>
                            </div>
                            <a id="viewEC" href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>                    

                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
	                    <!-- Temperature chart -->
			    <div id="temperature-chart-wrapper" >
        	                    <div class="panel panel-default">
                	                    <div class="panel-heading">
                        	                    <h3 class="panel-title"><i class="fa fa-sun-o fa-fw"></i> Temperature</h3>
                                            </div>
                                            <div class="panel-body">
                                	            <div id="temperature-chart"></div>
                                            </div>
                                    </div>
			    </div>

                            <!-- Humidity chart -->
                            <div id="humidity-chart-wrapper" >
                            	<div class="panel panel-default">
                                	<div class="panel-heading">
                                        	<h3 class="panel-title"><i class="fa fa-tint fa-fw"></i> Humidity</h3>
                                        </div>
                                        <div class="panel-body">
                                        	<div id="humidity-chart"></div>
                                        </div>
                                </div>
			    </div>
                            

                            <!-- pH chart -->
                            <div id="ph-chart-wrapper" >
                            	<div class="panel panel-default">
                                	<div class="panel-heading">
                                        	<h3 class="panel-title"><i class="fa fa-flask fa-fw"></i> pH</h3>
                                        </div>
                                        <div class="panel-body">
                                        	<div id="ph-chart"></div>
                                        </div>
                                </div>
			    </div>
                            

                            <!-- EC chart -->
                            <div id="ec-chart-wrapper" >
                            	<div class="panel panel-default">
                                	<div class="panel-heading">
                                        	<h3 class="panel-title"><i class="fa fa-bolt fa-fw"></i> EC</h3>
                                        </div>
                                        <div class="panel-body">
                                        	<div id="ec-chart"></div>
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

    <script>
        Morris.Area({
                element: 'temperature-chart',
                data: [
			<?php
				foreach($sensors['Temperature'] as $k=>$sensor){
                                    //print_r($sensor['DATA']);
                                    foreach($sensor['DATA'][0] as $kk=>$measurement){
                                        //print("---------");
                                        //print_r($measurement);
					echo "{d:'" . $measurement['mtime'] . "',temp:" . $measurement['VALUE']. "},";
                                    }
				}

			?>
                ],

                xkey: 'd',
                ykeys: ['temp'],
		labels: ['Temperature'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
        });
        
        Morris.Area({
                element: 'humidity-chart',
                data: [
			<?php
				foreach($sensors['Humidity'] as $k=>$sensor){
                                    //print_r($sensor['DATA']);
                                    foreach($sensor['DATA'][0] as $kk=>$measurement){
                                        //print("---------");
                                        //print_r($measurement);
					echo "{d:'" . $measurement['mtime'] . "',percent:" . $measurement['VALUE']. "},";
                                    }
				}

			?>
                ],

                xkey: 'd',
                ykeys: ['percent'],
		labels: ['Temperature'],
                lineColors: ['#5cb85c'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
        });        
        
        Morris.Area({
                element: 'ph-chart',
                data: [
			<?php
				foreach($sensors['pH'] as $k=>$sensor){
                                    //print_r($sensor['DATA']);
                                    foreach($sensor['DATA'][0] as $kk=>$measurement){
                                        //print("---------");
                                        //print_r($measurement);
					echo "{d:'" . $measurement['mtime'] . "',ph:" . $measurement['VALUE']. "},";
                                    }
				}

			?>
                ],

                xkey: 'd',
                ykeys: ['ph'],
		labels: ['pH'],
                lineColors: ['#f0ad4e'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
        });          
        
        Morris.Area({
                element: 'ec-chart',
                data: [
			<?php
				foreach($sensors['EC'] as $k=>$sensor){
                                    foreach($sensor['DATA'][0] as $kk=>$measurement){
					echo "{d:'" . $measurement['mtime'] . "',ec:" . $measurement['VALUE']. "},";
                                    }
				}

			?>
                ],

                xkey: 'd',
                ykeys: ['ec'],
		labels: ['EC'],
                lineColors: ['#d9534f'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
        });         


	//Scrolling handlers
	$("#viewTemperature").click(function() {
		$('html, body').animate({
	        	scrollTop: $("#temperature-chart-wrapper").offset().top
    		}, 500);
	});
        
	$("#viewHumidity").click(function() {
		$('html, body').animate({
	        	scrollTop: $("#humidity-chart-wrapper").offset().top
    		}, 500);
	});   
        
	$("#viewPh").click(function() {
		$('html, body').animate({
	        	scrollTop: $("#ph-chart-wrapper").offset().top
    		}, 500);
	});
        
	$("#viewEC").click(function() {
		$('html, body').animate({
	        	scrollTop: $("#ec-chart-wrapper").offset().top
    		}, 500);
	});        

    </script>
</body>

</html>

<?php
	$last_measurements->closeCursor();
	$last_measurements_array->closeCursor();
?>
