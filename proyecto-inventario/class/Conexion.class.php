<?php

  class Conexion extends PDO {
        public function __construct($database, $usuario='root', $password='') {
            $dsn = "mysql:host=localhost;dbname=$database";
            Parent::__construct($dsn, $usuario, $password);
        }
    }


?>
