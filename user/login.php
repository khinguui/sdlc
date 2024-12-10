<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $stuid=$_POST['stuid'];
    $password=md5($_POST['password']);
    $sql ="SELECT StuID,ID,StudentClass FROM tblstudent WHERE (UserName=:stuid || StuID=:stuid) and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':stuid', $stuid, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['sturecmsstuid']=$result->StuID;
$_SESSION['sturecmsuid']=$result->ID;
$_SESSION['stuclass']=$result->StudentClass;
}

  if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["stuid"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
} else {
if(isset($_COOKIE["user_login"])) {
setcookie ("user_login","");
if(isset($_COOKIE["userpassword"])) {
setcookie ("userpassword","");
        }
      }
}
$_SESSION['login']=$_POST['stuid'];
echo "<script type='text/javascript'> document.location ='check-grade.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}


?>



<!DOCTYPE html>
<html lang="zxx">
<head>
    
    <title>NEI Login Form </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">
    <script src="https://kit.fontawesome.com/35e003e337.js" crossorigin="anonymous"></script>

    

    <link rel="stylesheet" type="text/css" href="/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="/css2?family=Jost:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" />
</head>
<body id="top">

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<div class="page_loader"></div>

<div class="login-3 tab-box">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 bg-img">
                <div class="informeson">
                    <div class="typing">
                        <h1>  SMS </h1>
                    </div>
                    <p>
                    The  Student Management System simplifies student administration in educational institutions. It centralizes student records, facilitates course enrollment, and enables communication between students and faculty. With features like grade tracking and attendance management, it enhances efficiency and transparency, fostering improved student outcomes and administrative effectiveness.
                      </p>

                    <div class="social-list">
                        <div class="buttons">
                            <a href="https://facebook.com/Cutuan280803" class="facebook-bg"><i class="fa fa-facebook"></i></a>

                            <a href="#" class="github-bg">
                                <i class="fab fa-github"></i>
                            </a>
                            
                            <a href="#" class="google-bg"><i class="fa fa-google"></i></a>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 form-section">
                <div class="login-inner-form">
                    <div class="details">
                        <a href="../index.php" style="font-size: 70px; color: rgb(123,28,51);">
                             SMS
                        </a>
                        <h3>Sign Into Your Account</h3>
                        <form  id="login" method="POST" name="login">

                            <div class="form-group form-box">
                                <input type="text" name="stuid" class="form-control" placeholder="Enter username " aria-label="Email Address" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>">
                              
                                 
                               

                            </div>
                            <div class="form-group form-box">
                                <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password" required=true value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>">
                            </div>

                            <div class="form-group form-box checkbox clearfix">
                                <div class="form-check checkbox-theme">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                    <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>   Remember me
                                    </label>
                                </div>

                              
                                <a href="{{route('account.forgot_password')}}">Forgot Password</a>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-md btn-theme w-100" name="login">Login</button>
                            </div>
                            <p>Login Admin<a href="../admin/login.php"> Login Here </a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>



     
       
     

       
      
</body>
</html>