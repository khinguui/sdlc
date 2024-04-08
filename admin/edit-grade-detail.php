<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

// Kiểm tra đăng nhập
if (strlen($_SESSION['sturecmsaid']) == 0) {
    header('location:logout.php');
} else {
    // Xử lý khi nhấn nút "Cập nhật"
    if (isset($_POST['submit'])) {
        $remark = $_POST['remark'];
        $eid = $_POST['editid'];

  
        $grade = $remark;

        // Cập nhật điểm grade trong cơ sở dữ liệu
        $sql = "UPDATE tblgrades SET Grade=:grade WHERE ID=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':grade', $grade, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Grade has been updated")</script>';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Management System|| Edit Grade Detail</title>
    <!-- Các plugin:css -->
    <link rel="stylesheet" href="mainadmin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="mainadmin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="mainadmin/vendors/css/vendor.bundle.base.css">
    <!-- Endinject -->
    <!-- Plugin css cho trang này -->
    <link rel="stylesheet" href="mainadmin/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="mainadmin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css cho trang này -->
    <!-- Inject:css -->
    <!-- Endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="mainadmin/css/style.css" />
</head>
<body>
    <div class="container-scroller">
        <!-- header -->
        <?php include_once('includes/header.php');?>
        <div class="container-fluid page-body-wrapper">

        <!-- sidebar -->
        <?php include_once('includes/sidebar.php');?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Edit Grade Detail </h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"> Edit Grade Detail</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title" style="text-align: center;">Edit Grade Detail</h4>

                                <!-- Form chỉnh sửa điểm -->
                                <form class="forms-sample" method="post">
                                    <?php
                                    $eid = $_GET['editid'];
                                    $sql = "SELECT * FROM tblgrades WHERE ID=:eid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0) {
                                        foreach ($result as $row) {
                                    ?>
                                    <div class="form-group">
                                        <label for="grade">Grade</label>
                                        <input type="text" name="grade" value="<?php echo htmlentities($row->Grade); ?>" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="remark">Remark</label>
                                        <input type="text" name="remark" value="<?php echo htmlentities($row->Remark); ?>" class="form-control" required>
                                    </div>
                                    <input type="hidden" name="editid" value="<?php echo htmlentities($row->ID); ?>">
                                    <?php
                                        }
                                    }
                                    ?>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <?php include_once('includes/footer.php');?>

        </div>
        </div>
    </div>

    <!-- Các plugin:js -->
    <script src="mainadmin/vendors/js/vendor.bundle.base.js"></script>
    <!-- Endinject -->
    <!-- Plugin js cho trang này -->
    <script src="mainadmin/vendors/select2/select2.min.js"></script>
    <script src="mainadmin/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js cho trang này -->
    <!-- Inject:js -->
    <script src="mainadmin/js/off-canvas.js"></script>
    <script src="mainadmin/js/misc.js"></script>
    <!-- Endinject -->
    <!-- Custom js cho trang này -->
    <script src="mainadmin/js/typeahead.js"></script>
    <script src="mainadmin/js/select2.js"></script>
    <!-- End custom js cho trang này -->
</body>
</html>

<?php } ?>
