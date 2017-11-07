<?php
 require 'core.inc.php';
 require 'connect.inc.php';
 global $conn;
 
 if(!loggedin()) {
  
  if (isset($_POST['fname'])
	 &&isset($_POST['lname'])
	 &&isset($_POST['email'])
	 &&isset($_POST['password'])
	 &&isset($_POST['password_again'])){
   
   $first_name = $_POST['fname'];
   $last_name = $_POST['lname'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $password_again = $_POST['password_again'];
   $password_hash = md5($password);
   
 
   
   if (!empty($first_name)&&!empty($last_name)&&!empty($email)&&!empty($password)&&!empty($password_again)) {
    //checking if both password fields match
    if ($password!=@$password_again) {
     echo 'Passwords do no match.';
     } else {
     //checking if username already exist within database
     $query = "SELECT `email` FROM `test` WHERE `email`='$email'";
     $query_run = mysqli_query($conn, $query);
     
     if (mysqli_num_rows($query_run)==1) {
      echo 'The email '.$email.' already exists.';
      } else {
      //adding user to database
      $query = "INSERT INTO `test` VALUES ('', '".mysqli_real_escape_string($conn, $first_name)."', '".mysqli_real_escape_string($conn, $last_name)."', '".mysqli_real_escape_string($conn, $email)."', '".mysqli_real_escape_string($conn, $password_hash)."')";
      if ($query_run = mysqli_query($conn, $query)) {
      header('Location: register_success.php');
      } else {
       echo 'Sorry we couldn\'t register you at this time. Try again later.';
       }
     }
    }
    } else {
    echo 'All fields are required.';
   }
  }
  
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="register.php"method="POST"> <!--../../index.html-->  
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name = "fname" placeholder="First Name" value="<?php echo @$fname; ?>" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" name = "lname" placeholder="Last Name" value="<?php echo @$lname; ?>" >
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name = "email" placeholder="Email" value="<?php echo @$email; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name = "password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name = "password_again" placeholder="Retype password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="login.html" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
 <?php
  }else if(loggedin()) {
  echo 'You\'re already registered and logged in.';
 }
 
?>
