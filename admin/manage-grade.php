
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
    header('location:logout.php');
} else {
    // Code for deletion
    if(isset($_GET['delid'])) {
        $rid = intval($_GET['delid']);
        $sql = "delete from tblgrades where ID=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Data deleted');</script>"; 
        echo "<script>window.location.href = 'manage-grade.php'</script>";     
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Manage Grade</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="mainadmin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="mainadmin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="mainadmin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./mainadmin/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./mainadmin/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./mainadmin/css/style.css">
    <!-- End layout styles -->
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once('includes/header.php');?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Manage Grade </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Manage Grade</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex align-items-center mb-4">
                                    <h4 class="card-title mb-sm-0">Manage Grade</h4>
                                    <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Grades</a>
                                </div>
                                <div class="table-responsive border rounded p-1">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="font-weight-bold">S.No</th>
                                                <th class="font-weight-bold">Student Name</th>
                                                <th class="font-weight-bold">Class Name</th>
                                                <th class="font-weight-bold">Subject</th>
                                                <th class="font-weight-bold">Grade</th>
                                                <th class="font-weight-bold">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT tblgrades.ID, tblstudent.StudentName, tblclass.ClassName, tblgrades.Subject, tblgrades.Grade FROM tblgrades 
                                                    JOIN tblstudent ON tblgrades.StudentID = tblstudent.ID 
                                                    JOIN tblclass ON tblgrades.ClassID = tblclass.ID";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if($query->rowCount() > 0) {
                                                foreach($results as $row) { ?>
                                                    <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($row->StudentName);?></td>
                                                        <td><?php echo htmlentities($row->ClassName);?></td>
                                                        <td><?php echo htmlentities($row->Subject);?></td>
                                                        <td><?php echo htmlentities($row->Grade);?></td>
                                                        <td>
                                                            <div>
                                                                <a href="edit-grade-detail.php?editid=<?php echo htmlentities ($row->ID);?>"><i class="icon-eye"></i></a>
                                                                || 
                                                                <a href="manage-grade.php?delid=<?php echo ($row->ID);?>" onclick="return confirm('Do you really want to Delete ?');"> <i class="icon-trash"></i></a>
                                                            </div>
                                                        </td> 
                                                    </tr>
                                            <?php $cnt++; }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div

>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <?php include_once('includes/footer.php');?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="mainadmin/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="./mainadmin/vendors/chart.js/Chart.min.js"></script>
<script src="./mainadmin/vendors/moment/moment.min.js"></script>
<script src="./mainadmin/vendors/daterangepicker/daterangepicker.js"></script>
<script src="./mainadmin/vendors/chartist/chartist.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="mainadmin/js/off-canvas.js"></script>
<script src="mainadmin/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="./mainadmin/js/dashboard.js"></script>
<!-- End custom js for this page -->
</body>
</html>
```