<?php
session_start();
require_once 'class.user.php';
require_once 'connector.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM admin WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Llanes Farm</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Startmin</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="../index.html"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            <li class="dropdown navbar-inverse">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>See All Alerts</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $row['userEmail']; ?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">

                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="viewproductpage.php"><i class="fa fa-dashboard fa-fw"></i> Product</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Item</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Product</h1>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
                <?php
                    $prodID=$_POST['PNAME'];
                    $result = mysqli_query($dbconn ,"SELECT * FROM products WHERE productID = '". $prodID . "' LIMIT 1");
                    $row = mysqli_fetch_assoc($result);
                    echo "<div class='col-lg-6'>
                    <form role='form' action='editproductprocess.php' method='post'>
                        <div class='form-group'>
                            <label>Product ID</label>
                            <input type='number' class='form-control' maxlength='6' value=".$row['productID']." required readonly>
                        </div>
                        <div class='form-group'>
                            <label>Product Name</label>
                            <input type='text' class='form-control' maxlength='50' value=".$row['name']." required readonly>
                        </div>
                        <div class='form-group'>
                            <label>Product Price</label>
                            <input type='number' class='form-control' value=".$row['price']." required readonly>
                        </div>
                        <div class='form-group'>
                            <label>Product Quantity</label>
                            <input type='number' class='form-control' maxlength='100' value=".$row['quantity']." required readonly>
                        </div>
                        <div class='form-group'>
                            <label>Product Date Created</label>
                            <input type='date' class='form-control' maxlength='50' value=".$row['date_created']." required readonly>
                        </div>
                        <div class='form-group'>
                        <label>Product Image</label>
                            <input type='file' name='fileToUpload' id='fileToUpload' maxlength='200'>
                        </div>
                        <div class='form-group'>
                            <label>Product Description</label>
                            <textarea class='form-control' rows='10' maxlength='100' required readonly>".$row['description']."</textarea>
                        </div>
                        <hr>
                    </form>
                </div>";
                ?>
                <div class="row">
                <div class="col-lg-6">
                    <form role="form" action="editproductprocess.php" method="post">
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="number" class="form-control" name="editID" id="editID" <?php echo "value='".$row['productID']."'" ?> maxlength="6" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="editname" id="editname" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="number" class="form-control" name="editprice" id="editprice" required>
                        </div>
                        <div class="form-group">
                            <label>Product Quantity</label>
                            <input type="number" class="form-control" name="editquantity" id="edituantity" required maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Product Date Created</label>
                            <input type="date" class="form-control" name="editdate_created" id="editdate_created" <?php echo "value='".$row['date_created']."'" ?> maxlength="50" required readonly>
                        </div>
                        <div class="form-group">
                        <label>Product Image</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" maxlength="200">
                        </div>
                        <div class="form-group">
                            <label>Product Description</label>
                            <textarea class="form-control" rows="10" placeholder="Main Description" name="editdescription" id="editdescription" maxlength="500"></textarea>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Edit" name="submit">
                        <input type="reset" class="btn btn-default" value="Reset">
                        <hr>
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>

<!-- jQuery -->
<script src="js/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/startmin.js"></script>

</body>
</html>
