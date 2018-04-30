<?php
  var_dumb($_COOKIE);
  var_dump($_SESSION);

  if(isset($_GET['logout'])){
    session_start();
    session_destroy();

  } else {
    session_start();
    var_dumb($_SESSION);

  }

  if(isset($_SESSION['userName'])){
    echo "You are logged in as ' . $_SESSION['userName'] . '.click <a href="?logout">here to logout</a>.";
  } else {
    echo "You are not logged in.";
  }


 ?>
