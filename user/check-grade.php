<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsstuid']) == 0) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Check Grade</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="mainuser/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="mainuser/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="mainuser/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="mainuser/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="mainuser/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="mainuser/css/style.css"/>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php'); ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Check Grade </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Check Grade</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <table border="1" class="table table-bordered mg-b-0">
                                    <?php
                                    $suid = $_SESSION['sturecmsuid'];
                                    $sql = "SELECT Subject, Grade, ClassName FROM tblgrades INNER JOIN tblclass ON tblgrades.ClassID = tblclass.ID WHERE tblgrades.StudentID=:suid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':suid', $suid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        ?>
                                        <tr align="center" class="table-warning">
                                            <td colspan="4" style="font-size:20px;color:blue">Grade Information</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th>Subject</th>
                                            <th>Grade</th>
                                            <th>Class</th>
                                        </tr>
                                        <?php
                                        foreach ($results as $row) {
                                            ?>
                                            <tr class="table-info">
                                                <td><?php echo $row->Subject; ?></td>
                                                <td><?php echo $row->Grade; ?></td>
                                                <td><?php echo $row->ClassName; ?></td>
                                            </tr>
                                            <?php
                                            $cnt = $cnt + 1;
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <th colspan="3" style="color:red;">No Grade Found</th>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <?php include_once('includes/footer.php'); ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="mainuser/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="mainuser/vendors/select2/select2.min.js"></script>
<script src="mainuser/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="mainuser/js/off-canvas.js"></script>
<script src="mainuser/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="mainuser/js/typeahead.js"></script>
<script src="mainuser/js/select2.js"></script>
<!-- End custom js for this page -->
</body>
</html>
<?php } ?>