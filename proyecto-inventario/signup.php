<?php require('partials/__header.html')?>

  <?php

  session_start();

  if(isset($_SESSION['id_sesion'])){
    header('Location: admin/index.php');
  }

  spl_autoload_register(function($class){
    require "class/$class.class.php";
  });

  $users = new Users();
  $allUsers = $users->showUsers();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_sesion = uniqid();
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    # echo "<p>Usuario: $id_sesion, $user_name , $password, $name </p>";
    $users->signUp($id_sesion, $user_name, $password, $name);
    $allUsers = $users->showUsers();
    echo '<div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Signed Up!</strong> Thank you for Sign Up
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
          </div>';
  }else{
    echo '<div class="container">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>
          </div>';
  }

    // if(count($allUsers)) {
    //   echo "<table class='table text-white'>";
    //   echo "<tr class='bg-success'>";
    //       echo "<th>Id_Session</th>";
    //       echo "<th>User</th>";
    //       echo "<th>Password</th>";
    //       echo "<th> Name </th>";
    //       echo "<th> Action </th>";
    //    echo "</tr>";
    //
    //       foreach($allUsers as $user) {
    //         echo "<tr class='bg-info'>";
    //           echo "<td>$user->id_sesion</td>";
    //           echo "<td>$user->user_name</td>";
    //           echo "<td>$user->password</td>";
    //           echo "<td>$user->name</td>";
    //           echo "<td>";
    //         echo "<form action='' method='GET'>";
    //           echo "<input type='text' name='borrar' value='$user->id_sesion' style='display:none;'>";
    //           echo "<input type='submit' class='btn btn-danger'value='Borrar'>";
    //           echo "</form>";
    //           echo "</td>";
    //           echo "</tr>";
    //         }
    //   echo "</table>";
    //   }
  ?>

  <div class="container my-5 text-center">
    <div class="card mx-auto" style="width: 300px;">
      <div class="card-header">
        <h1> Sign Up </h1>
      </div>
      <div class="card-body">
        <form class="form-row align-items-center" action="signup.php" method="post">
          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> @ </div>
              </div>
              <input class="form-control" type="text" name="user_name" placeholder="Username" required>
            </div>
          </div>

          <div class="col-auto">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>
          </div>

            <div class="col-auto">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
                </div>
                <input class="form-control" type="text" name="name" placeholder="Name" required>
              </div>
            </div>

          </div>
          <div class="p-3">
            <input type="submit" class="btn btn-primary btn-block" name="submit" value="Sign Up">
          </div>
        </form>
        <div class="p-3">
          <a class="btn btn-secondary btn-block" href="index.php"> Login </a>
        </div>
      </div>
    </div>
  </div>
<?php require('partials/__footer.html')?>
