<?php
session_start();
// error_reporting(1);
include('includes/dbconnection.php');
if (strlen($_SESSION['tsasaid'] == 0)) {
    header('location:logout.php');
} else {

    if (isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "delete from tbladmin where ID=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'subject.php'</script>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <title>TSAS Manage Admin</title>

        <!-- Styles -->
        <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
        <link href="../assets/css/lib/datatable/dataTables.bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/lib/datatable/buttons.bootstrap.min.css" rel="stylesheet" />
        <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/lib/unix.css" rel="stylesheet">
        <link href="../assets/css/style.css" rel="stylesheet">
        <style>
            img {
                width: 100px;
            }
        </style>
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
                                    <h1>Manage Admin</h1>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        <div class="col-lg-4 p-l-0 title-margin-left">
                            <div class="page-header">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="dashboard.php">Dashboard</a></li>
                                        <li class="active">Manage Admin</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
                    <!-- /# row -->
                    <div id="main-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card alert">
                                    <div class="card-header">
                                        <h4>Manage Admin</h4>

                                    </div>
                                    <div class="bootstrap-data-table-panel">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered" style="overflow: hidden;">
                                                <thead>
                                                    <tr>
                                                        <th style="max-width: 50px; width: 20px;">S.No</th>
                                                        <th style="max-width: 50px; width: 20px;">Image</th>
                                                        <th>Admin Name</th>
                                                        <th>Username</th>
                                                        <th>Mobile Number</th>
                                                        <th>Email</th>
                                                        <th>Registerd Date</th>
                                                        <th style="max-width: 200px; width: 100px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                                        $page_no = $_GET['page_no'];
                                                    } else {
                                                        $page_no = 1;
                                                    }
                                                    // Formula for pagination
                                                    $no_of_records_per_page = 10;
                                                    $offset = ($page_no - 1) * $no_of_records_per_page;
                                                    $previous_page = $page_no - 1;
                                                    $next_page = $page_no + 1;
                                                    $adjacents = "2";
                                                    $ret = "SELECT ID FROM tbladmin";
                                                    $query1 = $dbh->prepare($ret);
                                                    $query1->execute();
                                                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                                                    $total_rows = $query1->rowCount();
                                                    $total_no_of_pages = ceil($total_rows / $no_of_records_per_page);
                                                    $second_last = $total_no_of_pages - 1; // total page minus 1
                                                    $sql = "SELECT * from tbladmin";
                                                    $query = $dbh->prepare($sql);
                                                    $query->execute();
                                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                                    $cnt = 1;
                                                    if ($query->rowCount() > 0) {
                                                        foreach ($results as $row) {               ?>

                                                            <tr>
                                                                <td><?php echo htmlentities($cnt); ?></td>
                                                                <td>
                                                                    <img src="images/<?php echo htmlentities($row->ProfilePic); ?>" alt="">
                                                                </td>
                                                                <td><?php echo htmlentities($row->FirstName); ?> <?php echo htmlentities($row->LastName); ?></td>
                                                                <td><?php echo htmlentities($row->UserName); ?></td>
                                                                <td><?php echo htmlentities($row->MobileNumber); ?></td>
                                                                <td><?php echo htmlentities($row->Email); ?></td>
                                                                <td><?php echo htmlentities($row->AdminRegdate); ?></td>

                                                                <td>
                                                                    <span><a href="manage-admin.php?delid=<?php echo ($row->ID); ?>" onclick="return confirm('Do you really want to Delete ?');"><i class="ti-trash color-danger"></i> </a></span>
                                                                </td>
                                                            </tr>
                                                    <?php $cnt = $cnt + 1;
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div align="left">
                                                        <ul class="pagination">

                                                            <li <?php if ($page_no <= 1) {
                                                                    echo "class='disabled'";
                                                                } ?>>
                                                                <a <?php if ($page_no > 1) {
                                                                        echo "href='?page_no=$previous_page'";
                                                                    } ?>>Previous</a>
                                                            </li>

                                                            <?php
                                                            if ($total_no_of_pages <= 10) {
                                                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                                                    if ($counter == $page_no) {
                                                                        echo "<li class='active'><a>$counter</a></li>";
                                                                    } else {
                                                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                                    }
                                                                }
                                                            } elseif ($total_no_of_pages > 10) {

                                                                if ($page_no <= 4) {
                                                                    for ($counter = 1; $counter < 8; $counter++) {
                                                                        if ($counter == $page_no) {
                                                                            echo "<li class='active'><a>$counter</a></li>";
                                                                        } else {
                                                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                                        }
                                                                    }
                                                                    echo "<li><a>...</a></li>";
                                                                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                                                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                                                    echo "<li><a href='?page_no=1'>1</a></li>";
                                                                    echo "<li><a href='?page_no=2'>2</a></li>";
                                                                    echo "<li><a>...</a></li>";
                                                                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                                                        if ($counter == $page_no) {
                                                                            echo "<li class='active'><a>$counter</a></li>";
                                                                        } else {
                                                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                                        }
                                                                    }
                                                                    echo "<li><a>...</a></li>";
                                                                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                                                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                                                } else {
                                                                    echo "<li><a href='?page_no=1'>1</a></li>";
                                                                    echo "<li><a href='?page_no=2'>2</a></li>";
                                                                    echo "<li><a>...</a></li>";

                                                                    for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                                                        if ($counter == $page_no) {
                                                                            echo "<li class='active'><a>$counter</a></li>";
                                                                        } else {
                                                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            ?>

                                                            <li <?php if ($page_no >= $total_no_of_pages) {
                                                                    echo "class='disabled'";
                                                                } ?>>
                                                                <a <?php if ($page_no < $total_no_of_pages) {
                                                                        echo "href='?page_no=$next_page'";
                                                                    } ?>>Next</a>
                                                            </li>
                                                            <?php if ($page_no < $total_no_of_pages) {
                                                                echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                                                            } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /# card -->
                            </div>
                            <!-- /# column -->
                        </div>
                        <!-- /# row -->
                        <?php include_once('includes/footer.php'); ?>
                    </div>
                </div>
            </div>
        </div>








        <div id="search">
            <button type="button" class="close">×</button>
            <form>
                <input type="search" value="" placeholder="type keyword(s) here" />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <!-- jquery vendor -->
        <script src="../assets/js/lib/bootstrap.min.js"></script>
        <!-- bootstrap -->
        <script src="../assets/js/lib/jquery.min.js"></script>
        <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
        <!-- nano scroller -->
        <script src="../assets/js/lib/menubar/sidebar.js"></script>
        <script src="../assets/js/lib/preloader/pace.min.js"></script>
        <!-- sidebar -->
        <script src="../assets/js/lib/data-table/datatables.min.js"></script>
        <script src="../assets/js/lib/data-table/datatables-init.js"></script>
        <script src="../assets/js/scripts.js"></script>
        <!-- scripit init-->
    <?php }  ?>








    </body>

    </html>