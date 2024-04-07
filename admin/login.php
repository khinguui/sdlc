<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['login'])) 
  {
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $sql ="SELECT ID FROM tbladmin WHERE UserName=:username and Password=:password";
    $query=$dbh->prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
{
foreach ($results as $result) {
$_SESSION['sturecmsaid']=$result->ID;
}

  if(!empty($_POST["remember"])) {
//COOKIES for username
setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
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
$_SESSION['login']=$_POST['username'];
echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
} else{
echo "<script>alert('Invalid Details');</script>";
}
}

?>










<!DOCTYPE html>
<html lang="en">


<head>
    <title>Login V1</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="loginadmin/images/icons/favicon.ico" />

        <link rel="stylesheet" type="text/css" href="loginadmin/vendor/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="loginadmin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="loginadmin/vendor/animate/animate.css">

        <link rel="stylesheet" type="text/css" href="loginadmin/vendor/css-hamburgers/hamburgers.min.css">

        <link rel="stylesheet" type="text/css" href="loginadmin/vendor/select2/select2.min.css">

        <link rel="stylesheet" type="text/css" href="loginadmin/css/util.css">
        <link rel="stylesheet" type="text/css" href="loginadmin/css/main.css">

        <meta name="robots" content="noindex, follow">
   
</head>
<body>
        <div class="limiter">
          <div class="container-login100">
              <div class="wrap-login100">
                  <div class="login100-pic js-tilt" data-tilt>
                      <img src="loginadmin/images/img-01.png" alt="IMG">
                  </div>
                  <form class="login100-form validate-form" action="" method="POST" name="login">
                        
            
                      <span class="login100-form-title">
                          Admin  Login
                      </span>
                  
                      
               
                      <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                          <input class="input100" type="text" name="username" placeholder="Username" required>
                          <span class="focus-input100"></span>
                          <span class="symbol-input100">
                              <i class="fa fa-envelope" aria-hidden="true"></i>
                          </span>
                      </div>
                      <div class="wrap-input100 validate-input" data-validate="Password is required">
                          <input class="input100" type="password" name="password" placeholder="Password">
                          <span class="focus-input100"></span>
                          <span class="symbol-input100">
                              <i class="fa fa-lock" aria-hidden="true"></i>
                          </span>
                      </div>
                      <div class="container-login100-form-btn">
                          <button type="submit" class="login100-form-btn" name="login">
                              Login
                          </button>
                         
                      </div>
                      
                  </form>
                  
              </div>
          </div>
      </div>

    <script src="loginadmin/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="loginadmin/vendor/bootstrap/js/popper.js"></script>
    <script src="loginadmin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="loginadmin/vendor/select2/select2.min.js"></script>

    <script src="loginadmin/vendor/tilt/tilt.jquery.min.js"></script>

    <script>
        $('.js-tilt').tilt({
          scale: 1.1
        })
      </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
    </script>

    <script src="loginadmin/js/main.js"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"86a09c778f722ea4","b":1,"version":"2024.3.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>


</html>
