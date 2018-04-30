<?php
  session_start();

  $password = 'password';

  $userPass = $_POST['password'];

    if($userPass == $password){
      $_SESSION['userName'] = $_POST['name'];
      echo 'User has logged in. <a href="verify.php">Verify</a>';

    } else {
      echo 'Password does not match. ';
    }

?>
