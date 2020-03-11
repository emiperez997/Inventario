<?php


  class Users{
        const DB = 'inventario';
        const USUARIO = 'root';
        const PASSWORD = '';

        public function signUp($id_sesion, $user_name, $password, $name) {
            try {
                $conexion = new Conexion(Users::DB, Users::USUARIO, Users::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $accion->addUser($id_sesion, $user_name, $password, $name);
                $conexion = NULL;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }

        public function showUsers() {
            try {
                $conexion = new Conexion(Users::DB, Users::USUARIO, Users::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $prod = $accion->readUsers();
                $conexion = NULL;

                return $prod;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }

        public function showOneUser($id_sesion) {
            try {
                $conexion = new Conexion(Users::DB, Users::USUARIO, Users::PASSWORD);

                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $accion = new Action($conexion);
                $user = $accion->readOneUser($id_sesion);
                $conexion = NULL;

                return $user;
            }
            catch(Exception $ex) {
                echo "<p>Hubo un error en el acceso a la base de datos</p>";
                echo "<p>{$ex->getMessage()}</p>";
                echo "<p>{$ex->getCode()}</p>";
            }
        }

        public function verifyUser($user_name, $password){
          try {
              $conexion = new Conexion(Users::DB, Users::USUARIO, Users::PASSWORD);

              $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $accion = new Action($conexion);
              $user = $accion->verify($user_name, $password);
              $conexion = NULL;

              return $user;
          }
          catch(Exception $ex) {
              echo "<p>Hubo un error en el acceso a la base de datos</p>";
              echo "<p>{$ex->getMessage()}</p>";
              echo "<p>{$ex->getCode()}</p>";
          }
        }
  }


?>
