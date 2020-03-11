<?php
    class Action {

        public $conexion = NULL;
        public function __construct(Conexion $conexion) {
            $this->conexion = $conexion;
        }

        # --------------------------------------
        # Usuarios
        # --------------------------------------
        public function addUser($id_sesion, $user_name, $password, $name) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "INSERT INTO usuarios (id_sesion, user_name, password, name, access)
                    VALUES (:id_sesion, :user_name, :password, :name, 0)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id_sesion', $id_sesion);
            $stmt->bindValue(':user_name', $user_name);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':name', $name);

            $stmt->execute();
        }

        public function readUsers() {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "SELECT id_sesion, user_name, name, access FROM usuarios";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, "User");
        }

        public function readOneUser($id_sesion) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "SELECT id_sesion, user_name, name, access FROM usuarios WHERE id_sesion = :id_sesion";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id_sesion', $id_sesion);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, "User");
        }

        public function deleteUser($id_sesion) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "DELETE FROM usuarios WHERE id_sesion = :id_sesion";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id_sesion', $id_sesion);
            $stmt->execute();
        }

        public function verify($user_name, $password){
          if($this->conexion == NULL) {
              throw new Exception('Error de conexión');
          }
          $sql = "SELECT id_sesion, user_name, password, name, access FROM usuarios WHERE user_name = :user_name";
          $stmt = $this->conexion->prepare($sql);
          $stmt->bindValue(':user_name', $user_name);
          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $result['password'])){
              return $result;
            }
        }

        # --------------------------------------
        # Products
        # --------------------------------------
        public function addProduct($id, $name, $description, $price, $brand, $user) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "INSERT INTO productos (id, name, description, price, brand, user)
                    VALUES (:id, :name, :description, :price, :brand, :user)";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':brand', $brand);
            $stmt->bindValue(':user', $user);

            $stmt->execute();
        }

        public function readProducts() {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "SELECT id, name, description, price, brand, date FROM productos ORDER BY date DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, "Product");
        }

        public function readOneProduct($id) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "SELECT id, name, description, price, brand, date FROM productos WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_CLASS, "Product");
        }

        public function deleteProduct($id) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "DELETE FROM productos WHERE id=:id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }

        public function updateProduct($id, $name, $description, $price, $brand) {
            if($this->conexion == NULL) {
                throw new Exception('Error de conexión');
            }
            $sql = "UPDATE productos SET name = :name, description = :description, price = :price, brand = :brand WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':description', $description);
            $stmt->bindValue(':price', $price);
            $stmt->bindValue(':brand', $brand);

            $stmt->execute();
        }

    }
?>
