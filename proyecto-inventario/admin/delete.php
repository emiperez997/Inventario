<?php

  session_start();

  if(!isset($_SESSION['id_sesion'])){ header('Location: ../login.php'); }

  spl_autoload_register(function($class){
    require "../class/$class.class.php";
  });

  $inventory = new Inventory();

  if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_product'])){
    $id = $_GET['id_product'];
    $inventory->delete($id);
    header('Location: index.php');
  }




?>
