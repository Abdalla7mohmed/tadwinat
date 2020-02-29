<?php
  session_start();
  session_unset(); //REMOVE SESSION VARIABLE
  session_destroy();
  header('LOCATION:login.php')

 ?>
