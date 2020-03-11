<?php require('partials/__header.html')?>

<?php

  session_start();

  if(!isset($_SESSION['id_sesion'])){ header('Location: ../login.php'); }

  spl_autoload_register(function($class){
    require "../class/$class.class.php";
  });

  $inventory = new Inventory();
  $users = new Users();

  if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_product'])){
    $product = $inventory->showOneProduct($_GET['id_product']);
  }

  if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id_sesion'])){
    // var_dump($_GET);
    $id = $_GET['id_sesion'];
    $user = $users->showOneUser($id);
  }


  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])){
    $price = (float) $_POST['price'];
    $inventory->update($_POST['id'], $_POST['name'], $_POST['description'], $price, $_POST['brand']);
    //var_dump($_POST);
    header('Location: index.php');
    echo "<div class='alert alert-success'> Product Added </div>";
  }
?>

<?php if(isset($product)){ ?>
  <div class="container mt-3 text-center">
    <div class="card mx-auto" style="width: 700px;">
      <div class="card-header">
        <h3> Edit Product </h3>
      </div>
      <div class="card-body">
        <form class="form-row align-items-center" action="edit.php" method="post">
          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="text" name="id" value="<?= $product[0]->id ?>" readonly="readonly">
            </div>
          </div>

          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="text" name="name" value="<?= $product[0]->name ?>" required>
            </div>
          </div>

          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <textarea class="form-control" name="description" rows="4" cols="80" required> <?= $product[0]->description ?> </textarea>
            </div>
          </div>

          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> $ </div>
              </div>
              <input class="form-control" type="text" name="price" value="<?= $product[0]->price ?>" required>
            </div>
          </div>

            <div class="col-12">
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
                </div>
                <input class="form-control" type="text" name="brand" value="<?= $product[0]->brand ?>" required>
              </div>
            </div>

          </div>
          <div class="p-3">
            <button type="submit" class="btn btn-primary"> Update Product</button>
          </div>
        </form>
      </div>
  </div>
<?php } ?>

<?php if(isset($user)){ ?>
  <div class="container mt-3 text-center">
    <div class="card mx-auto" style="width: 700px;">
      <div class="card-header">
        <h3> Edit User </h3>
      </div>
      <div class="card-body">
        <form class="form-row align-items-center" action="edit.php" method="post">
          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="text" name="id" value="<?= $user[0]->id_sesion ?>" readonly="readonly">
            </div>
          </div>

          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="text" name="name" value="<?= $user[0]->user_name ?>" required>
            </div>
          </div>

          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="text" name="name" value="<?= $user[0]->name ?>" required>
            </div>
          </div>

          <div class="col-12">
            <div class="input-group">
                <!-- <input class="form-control" type="text" name="price" value="<?= $user[0]->access ?>" required> -->
                <div class="form-group">
                    <select class="form-control" name="access" id="list">
                      <option value="0" <?= ($user[0]->access == '0') ? 'selected' : '' ?>> 0 </option>
                      <option value="1" <?= ($user[0]->access == '1') ? 'selected' : '' ?>> 1 </option>
                      <option value="2" <?= ($user[0]->access == '2') ? 'selected' : '' ?>> 2 </option>
                    </select>
                </div>

            </div>
          </div>

          <div class="col-12">
            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <div class="input-group-text"> &nbsp;&nbsp;&nbsp; </div>
              </div>
              <input class="form-control" type="password" name="password" placeholder="Password" required>
            </div>
          </div>

          </div>
          <div class="p-3">
            <button type="submit" class="btn btn-primary"> Update User </button>
          </div>
        </form>
      </div>
  </div>
<?php } ?>

<?php require('partials/__footer.html')?>
