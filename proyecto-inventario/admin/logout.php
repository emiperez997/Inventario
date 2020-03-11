<?php

  session_start();

  if(isset($_SESSION['id_sesion'])){
    session_destroy();
    header('Location: ../index.php');
  }else{
    header('Location: ../index.php');
  }



?>
