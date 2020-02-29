<?php
  session_start();
  include('include/connection.php');

  $adminMail = $_POST['email'];
  $adminPass = $_POST['password'];
  $login = $_POST['log'];

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تسجيل الدخول</title>
    <!-- Bootstrap and Bootstrap Rtl -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.css">
    <!-- Custom css -->
    <link rel="stylesheet" href="css/dashboard.css">

<style>
  .login{
    width: 300px;
    margin: 80px auto;
  }
  .login h5{
    color: #555;
    margin-bottom: 30px;
    margin-top: 10px;
    text-align: center;
  }
  .login button{
    margin-right: 80px;
  }

</style>

</head>

<body>

  <div class="login">
        <?php
        if (isset($login)) {
          if(empty($adminMail) || empty($adminPass)){
            echo "<div class='alert alert-danger'>" . "الرجاء إدخال البريد الإلكتروني وكلمة السر" . "</div";
          }
          else {
            $query = "SELECT * FROM admin WHERE email='$adminMail' AND password='$adminPass'";
            $resutl = mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($resutl);

            if (in_array($adminMail,$row) && in_array($adminPass,$row)) {
              echo "<div class='alert alert-success'>" . "مرحباً , سيتم تحويلك الى لوحة التحكم" . "</div";
              $_SESSION['id'] = $row['id'];
              header('REFRESH:2;URL=categories.php');
            }
            else {
              echo "<div class='alert alert-danger'>" . "البيانات غير متطابقة" . "</div";
            }

          }
        }
     ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      <h5>تسجيل الدخول</h5>
      <div class="form-group">
        <label for="mail">البريد الإلكتروني</label>
        <input type="text" class="form-control"  id="mail" name="email"/>
      </div>
      <div class="form-group">
        <label for="pass">كلمة السر</label>
        <input type="text" class="form-control"  id="pass" name="password"/>
      </div>
      <button class="custom-btn" name="log">تسجيل الدخول</button>
    </form>
  </div>

  <!--jQuery-->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!--Font Awesome-->
  <script src="https://kit.fontawesome.com/03757ac844.js"></script>
  <!--Bootstrap-->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
</body>
</html>
