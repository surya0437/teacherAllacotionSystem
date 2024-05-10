<?php
session_start();
// error_reporting(1);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        // $empid = $_POST['empid'];
        $empid = rand(100000, 999999);
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobnum = $_POST['mobnum'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password != $confirmPassword) {
            echo "<script>alert('Password and confirm password is not matching');</script>";
        } else {
            $propic = $_FILES["propic"]["name"];
            $extension = substr($propic, strlen($propic) - 4, strlen($propic));
            $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
            if (!in_array($extension, $allowed_extensions)) {
                echo "<script>alert('Profile Pics has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
            } else {

                $propic = md5($propic) . time() . $extension;
                move_uploaded_file($_FILES["propic"]["tmp_name"], "adminImage/" . $propic);
                $ret = "select * from tbladmin where Email=:email || MobileNumber=:mobnum || UserName=:username";
                $query = $dbh->prepare($ret);
                $query->bindParam(':username', $username, PDO::PARAM_STR);
                $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
                $query->bindParam(':email', $email, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                if ($query->rowCount() == 0) {

                    $sql = "insert into tbladmin(ID,FirstName,LastName,MobileNumber,UserName,Password,Email,ProfilePic)values(:empid,:fname,:lname,:mobnum,:username,:password,:email,:propic)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':empid', $empid, PDO::PARAM_STR);
                    $query->bindParam(':fname', $fname, PDO::PARAM_STR);
                    $query->bindParam(':lname', $lname, PDO::PARAM_STR);
                    $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
                    $query->bindParam(':username', $username, PDO::PARAM_STR);
                    $query->bindParam(':password', $password, PDO::PARAM_STR);
                    $query->bindParam(':email', $email, PDO::PARAM_STR);
                    $query->bindParam(':propic', $propic, PDO::PARAM_STR);
                    $result = $query->execute();

                    if ($result) {
                        echo '<script>alert("Admin detail has been added.")</script>';
                        echo "<script>window.location.href ='add-admin.php'</script>";
                    } else {
                        echo '<script>alert("Something Went Wrong. Please try again")</script>';
                    }
                } else {

                    echo "<script>alert('Email-id,User name or Mobile Number already exist. Please try again');</script>";
                }
            }
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>TSAS : Add Admin Information </title>

        <link href="../assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
        <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/lib/unix.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
    </head>

    <body>

        <?php include_once('includes/sidebar.php'); ?>

        <?php include_once('includes/header.php'); ?>

        <div class="content-wrap">
            <div class="main">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 p-r-0 title-margin-right">
                            <div class="page-header">
                                <div class="page-title">
                                    <h1>Add Admin</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="dashboard.php">Dashboard</a></li>
                                        <li class="active">Admin Information</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    <div id="main-content">
                        <div class="card alert">
                            <div class="card-body">
                                <form name="" method="post" action="" enctype="multipart/form-data">
                                    <div class="card-header m-b-20">
                                        <h4>Admin Information</h4>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control border-none input-flat bg-ash" name="fname" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control border-none input-flat bg-ash" name="lname" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control border-none input-flat bg-ash" name="mobnum" maxlength="10" pattern="[0-9]+" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control border-none input-flat bg-ash" name="email" required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control border-none input-flat bg-ash" name="username" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="password" class="form-control border-none input-flat bg-ash" name="password" required="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="basic-form">
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control border-none input-flat bg-ash" name="confirmPassword" required="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" <div class="col-md-12">
                                        <div class="basic-form">
                                            <div class="form-group image-type">
                                                <label>Upload Teacher Photo <span>(150 X 150)</span></label>
                                                <input type="file" name="propic" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                        <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button>
                        </form>
                    </div>
                </div>

                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
        </div>
        </div>
        <!-- jquery vendor -->
        <script src="../assets/js/lib/jquery.min.js"></script>
        <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="../assets/js/lib/menubar/sidebar.js"></script>
        <script src="../assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="../assets/js/lib/bootstrap.min.js"></script>
        <!-- bootstrap -->


        <script src="../assets/js/lib/calendar-2/moment.latest.min.js"></script>
        <!-- scripit init-->
        <script src="../assets/js/lib/calendar-2/semantic.ui.min.js"></script>
        <!-- scripit init-->
        <script src="../assets/js/lib/calendar-2/prism.min.js"></script>
        <!-- scripit init-->
        <script src="../assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
        <!-- scripit init-->
        <script src="../assets/js/lib/calendar-2/pignose.init.js"></script>
        <!-- scripit init-->

        <script src="../assets/js/scripts.js"></script>
    </body>

    </html><?php }  ?>