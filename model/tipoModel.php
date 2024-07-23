<?php
    class TiposModel {

        private $DBConecction;

        public function __construct() {
            require_once("app/config/BDConecction.php");
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todos los tipos
        public function getAll() {
            $consulta = "SELECT * FROM tipos";
            $coneccion = $this->DBConecction->getConeccion();
            $resultado = $coneccion->query($consulta);
            $tipos = array();
            while ($tipo = $resultado->fetch_assoc()) {
                $tipos[] = $tipo;
            }
            $this->DBConecction->closeConeccion();
            return $tipos;
        }

        // Método para obtener un tipo por su ID
        public function getById($id) {
            $consulta = "SELECT * FROM tipos WHERE id = " . $id;
            $coneccion = $this->DBConecction->getConeccion();
            $resultado = $coneccion->query($consulta);
            if ($resultado && $resultado->num_rows > 0) {
                $tipo = $resultado->fetch_assoc();
            } else {
                $tipo = false;
            }
            $this->DBConecction->closeConeccion();
            return $tipo;
        }

        // Método para eliminar un tipo
        public function delete($id) {
            $consulta = "DELETE FROM tipos WHERE id = " . $id;
            $coneccion = $this->DBConecction->getConeccion();
            $respuesta = $coneccion->query($consulta);
            $this->DBConecction->closeConeccion();
            // Retornar true si la eliminación fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para insertar un nuevo tipo
        public function insert($tipo) {
            // Crear la consulta para insertar un nuevo tipo
            $consulta = "INSERT INTO tipos (nombre_tipo) VALUES (
                '" . $tipo['nombre_tipo'] . "'
            )";
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            $respuesta = $coneccion->query($consulta);
            $this->DBConecction->closeConeccion();
            return $respuesta;
        }

        // Método para editar un tipo existente
        public function edit($tipo) {
            $consulta = "UPDATE tipos SET 
                nombre_tipo = '" . $tipo['nombre_tipo'] . "'
                WHERE id = " . $tipo['id'];
            $coneccion = $this->DBConecction->getConeccion();
            $respuesta = $coneccion->query($consulta);
            $this->DBConecction->closeConeccion();
            return $respuesta;
        }
    }
?>

