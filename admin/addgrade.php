<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
    header('location:logout.php');
} else {
    if(isset($_POST['submit'])) {
        $studentID = $_POST['studentid'];
        $classID = $_POST['classid'];
        $subject = $_POST['subject'];
        $grade = $_POST['grade'];

        $sql = "INSERT INTO tblgrades (StudentID, ClassID, Subject, Grade) VALUES (:studentid, :classid, :subject, :grade)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $studentID, PDO::PARAM_INT);
        $query->bindParam(':classid', $classID, PDO::PARAM_INT);
        $query->bindParam(':subject', $subject, PDO::PARAM_STR);
        $query->bindParam(':grade', $grade, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<script>alert("Grade has been added.")</script>';
            echo "<script>window.location.href ='addgrade.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System || Add Grade</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="mainadmin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="mainadmin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="mainadmin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="mainadmin/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="mainadmin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="mainadmin/css/style.css"/>
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
                    <h3 class="page-title"> Add Grade </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Add Grade</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Add Grade</h4>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="studentid">Student Name</label>
                                        <select name="studentid" class="form-control" required>
                                            <option value="">Select Student</option>
                                            <?php
                                            $sql = "SELECT ID, StudentName FROM tblstudent";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {
                                                    echo "<option value='" . $row['ID'] . "'>" . $row['StudentName'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="classid">Class</label>
                                        <select name="classid" class="form-control" required>
                                            <option value="">Select Class</option>
                                            <?php
                                            $sql = "SELECT ID, ClassName FROM tblclass";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {
                                                    echo "<option value='" . $row['ID'] . "'>" . $row['ClassName'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <select name="subject" class="form-control" required>
                                            <option value="">Select Subject</option>
                                            <?php
                                            $sql = "SELECT ID, SubjectName FROM tblsubject";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_ASSOC);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $row) {
                                                    echo "<option value='" . $row['SubjectName'] . "'>" . $row['SubjectName'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="grade">Grade</label>
                                        <input type="text" name="grade" class="form-control" required="true">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
<script src="mainadmin/vendors/select2/select2.min.js"></script>
<script src="mainadmin/vendors/typeahead.js/typeahead.bundle.min.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="mainadmin/js/off-canvas.js"></script>
<script src="mainadmin/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="mainadmin/js/typeahead.js"></script>
<script src="mainadmin/js/select2.js"></script>
<!-- End custom js for this page -->
</body>
</html>
