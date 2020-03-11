<?php


  class Inventory{
        const DB = 'inventario';
        const USUARIO = 'root';
        const PASSWORD = '';

        public function add($id, $name, $description, float $price, $brand, $user) {
            try {
                $conexion = new Conexion(Inventory::DB, Inventory::USUARIO, Inventory::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $accion->addProduct($id, $name, $description, $price, $brand, $user);
                $conexion = NULL;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }

        public function showProducts() {
            try {
                $conexion = new Conexion(Inventory::DB, Inventory::USUARIO, Inventory::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $prod = $accion->readProducts();
                $conexion = NULL;

                return $prod;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }

        public function showOneProduct($id) {
            try {
                $conexion = new Conexion(Inventory::DB, Inventory::USUARIO, Inventory::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $prod = $accion->readOneProduct($id);
                $conexion = NULL;

                return $prod;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }

        public function delete($id){
          try {
              $conexion = new Conexion(Inventory::DB, Inventory::USUARIO, Inventory::PASSWORD);

              $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $accion = new Action($conexion);
              $prod = $accion->deleteProduct($id);
              $conexion = NULL;

              return $prod;
          }
          catch(Exception $ex) {
              echo "<p>Hubo un error en el acceso a la base de datos</p>";
              echo "<p>{$ex->getMessage()}</p>";
              echo "<p>{$ex->getCode()}</p>";
          }
        }

        public function update($id, $name, $description, float $price, $brand) {
            try {
                $conexion = new Conexion(Inventory::DB, Inventory::USUARIO, Inventory::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $accion->updateProduct($id, $name, $description, $price, $brand);
                $conexion = NULL;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }
  }


?>
