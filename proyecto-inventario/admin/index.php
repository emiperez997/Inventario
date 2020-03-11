<?php require('partials/__header.html')?>

<?php

  session_start();

  if(!isset($_SESSION['id_sesion'])){ header('Location: ../login.php'); }

  spl_autoload_register(function($class){
    require "../class/$class.class.php";
  });

  $users = new Users();
  $allUsers = $users->showUsers();

  $inventory = new Inventory();
  $products = $inventory->showProducts();

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $price = (float) $_POST['price'];
    $inventory->add($_POST['id'], $_POST['name'], $_POST['description'], $price, $_POST['brand']);
    //var_dump($_POST);
    header('Location: index.php');
    echo "<div class='alert alert-success'> Product Added </div>";
  }

?>

<div class="container-fluid">
  <div class="row">
  <div class="col-3">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <h5 class="nav-link disable border-bottom text-center"><i> <strong> <?=  $_SESSION['user_name'] ?> </strong> </i> </h5>

      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"> Products </a>
      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"> Users</a>
      <a class="nav-link <?= ($_SESSION['access'] == '0') ? 'disabled' : '' ?>" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"> Add Product</a>
      <a class="nav-link <?= ($_SESSION['access'] !== '2') ? 'disabled' : '' ?>" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"> Admin Users </a>
    </div>
  </div>
  <div class="col-9">
    <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <!-- Products -->
        <div class="container mt-3">

          <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Order
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"> Name </a>
                  <a class="dropdown-item" href="#"> Date </a>
                  <a class="dropdown-item" href="#"> Low Price</a>
                  <a class="dropdown-item" href="#"> Max Price </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">  </a>
                </div>
              </li>
            </ul>
          </nav> -->

          <?php if(count($products)) {?>
            <ul class="list-unstyled">
              <?php foreach($products as $product): ?>
                <li class="media alert alert-primary">
                  <div class="media-body">
                    <h3> <?= $product->name ?> </h3>
                     <?= $product->description ?>
                     <hr>
                    <h5> $ <?= $product->price ?></h5>
                    <h5> <?= $product->brand ?> </h5>
                    <h5> <?= $product->date ?> </h5>
                    <?php if($_SESSION['access'] == 1 || $_SESSION['access'] == 2){ ?>
                      <hr>
                      <a href="edit.php?id_product=<?= $product->id ?>" class="btn btn-success"> Edit </a>
                      <a href="delete.php?id_product=<?= $product->id ?>" class="btn btn-danger"> Delete</a>
                    <?php } ?>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php }else{ ?>
            <div class="alert alert-primary">
              <h1> <strong> Oops! </strong> </h1>
              <h3> Apparently there are no products to show </h3>
              <h3> Enter the <b> "add product" </b> tab</h3>
            </div>

          <?php } ?>
        </div>

      </div>
      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

        <!-- Add Product -->
        <div class="container mt-3 text-center">
          <div class="card mx-auto" style="width: 700px;">
            <div class="card-header">
              <h3> Add Product </h3>
            </div>
            <div class="card-body">
              <form class="form-row align-items-center" action="index.php" method="post">
                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"> ID </div>
                    </div>
                    <input class="form-control" type="text" name="id" value="<?= uniqid(); ?>" readonly="readonly">
                  </div>
                </div>

                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
                    </div>
                    <input class="form-control" type="text" name="name" placeholder="Name" required>
                  </div>
                </div>

                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
                    </div>
                    <textarea class="form-control" name="description" rows="4" cols="80" required placeholder="Description"></textarea>
                  </div>
                </div>

                <div class="col-12">
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text"> $ </div>
                    </div>
                    <input class="form-control" type="text" name="price" placeholder="Price" required>
                  </div>
                </div>

                  <div class="col-12">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
                      </div>
                      <input class="form-control" type="text" name="brand" placeholder="Brand" required>
                    </div>
                  </div>

                </div>
                <div class="p-3">
                  <button type="submit" class="btn btn-primary" name="button"> Add Product</button>
                </div>
              </form>
            </div>
          </div>

        </div>

      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">

        <!-- Users -->
        <div class="container mt-3">
          <ul class="list-unstyled">
            <?php foreach($allUsers as $user): ?>
              <li class="media alert <?php
                switch ($user->access) {
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
                  <h3> Username: <?= $user->user_name ?> </h3>
                  <h5> Name: <?= $user->name ?></h5>
                  <h5> Access: <strong class=" <?php
                    switch ($user->access) {
                      case '0':
                        echo 'text-warning';
                        break;

                      case '1':
                        echo 'text-primary';
                        break;

                      case '2':
                        echo 'text-success';
                        break;
                    }
                  ?> "> <?= $user->access ?> </strong> </h5>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>

        </div>

      </div>
      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">

        <!-- Admin Users -->
        <div class="container mt-3">
          <ul class="list-unstyled">
            <?php foreach($allUsers as $user): ?>
              <li class="media alert <?php
                switch ($user->access) {
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
                  <h3> Username: <?= $user->user_name ?> </h3>
                  <h5> Name: <?= $user->name ?></h5>
                  <h5> Access: <strong class=" <?php
                    switch ($user->access) {
                      case '0':
                        echo 'text-warning';
                        break;

                      case '1':
                        echo 'text-primarya';
                        break;

                      case '2':
                        echo 'text-success';
                        break;
                    }
                  ?> "> <?= $user->access ?> </strong> </h5>
                  <a href="edit.php?id_sesion=<?= $user->id_sesion ?>" class="btn btn-success"> Edit </a>
                  <a href="delete.php?id_sesion=<?= $user->id_sesion ?>" class="btn btn-danger"> Delete</a>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>

        </div>

      </div>
    </div>
  </div>
</div>


<?php require('partials/__footer.html')?>
