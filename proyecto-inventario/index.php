<?php require('partials/__header.html')?>

<?php

  session_start();

  if(isset($_SESSION['id_sesion'])){
    header('Location: admin/index.php');
  }

  // var_dump($_SESSION);

?>

<div class="container my-5 text-center">
  <div class="card mx-auto" style="width: 300px;">
    <div class="card-header">
      <h1> <i> Log In </i> </h1>
    </div>
    <div class="card-body">
      <form class="form-row align-items-center" action="index.php" method="post">
        <div class="col-auto">
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text"> @ </div>
            </div>
            <input class="form-control" type="text" name="user_name" placeholder="Username">
          </div>
        </div>

        <div class="col-auto">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
            </div>
            <input class="form-control" type="password" name="password" placeholder="Password">
          </div>
        </div>
        </div>
        <div class="p-3">
          <input type="submit" value="Login" class="btn btn-primary btn-block">
        </div>
      </form>
      <div class="p-3">
        <a href="signup.php" class="btn btn-secondary btn-block"> Sign Up</a>
      </div>
    </div>
  </div>
</div>

<?php
  spl_autoload_register(function($class){
    require "class/$class.class.php";
  });

  $users = new Users();
  $allUsers = $users->showUsers();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $users->verifyUser($_POST['user_name'], $_POST['password']);
    if(isset($login)){
      $_SESSION['id_sesion'] = $login['id_sesion'];
      $_SESSION['user_name'] = $login['user_name'];
      $_SESSION['name'] = $login['name'];
      $_SESSION['access'] = $login['access'];
      header('Location: admin/index.php');
    }else{
      echo '<div class="container">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Username or Password Incorrect
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
              </div>
            </div>';
    }
  }



?>



<?php require('partials/__footer.html')?>
