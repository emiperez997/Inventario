<?php require('partials/__header.html')?>

<?php

  session_start();

  if(!isset($_SESSION['id_sesion'])){ header('Location: ../index.php'); }
?>

<div class="container mt-2">
  <div class="media alert <?php
    switch ($_SESSION['access']) {
      case '0':
        echo 'alert-warning';
        break;

      case '1':
        echo 'alert-primary';
        break;

      case '2':
        echo 'alert-success';
        break;
    }
  ?>">
  <div class="media-body">
    <h5 class="mt-0"> <?= $_SESSION['user_name'] ?></h5>
    <hr>
    <p> Name: <?= $_SESSION['name'] ?> </p>
    <p> Access: <strong> <?= $_SESSION['access'] ?> </strong> </p>

    <hr>
    <a class="btn btn-success" href="edit?id_sesion=<?= $_SESSION['id_sesion'] ?>"> Edit </a>
    <a href="delete.php?id_session=<?= $user->id_sesion ?>" class="btn btn-danger"> Delete </a>

  </div>
</div>
</div>

<?php require('partials/__footer.html')?>
