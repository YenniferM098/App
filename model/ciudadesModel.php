<?php
    class CiudadModel {
        // Atributo para la conexión a la base de datos
        private $DBConecction;

        // Constructor para conectar con la base de datos
        public function __construct() {
            // Solicitar la clase de conexión
            require_once("app/config/BDConecction.php");
            // Crear un objeto de la base de datos utilizando el atributo DBConecction
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todas las ciudades
        public function getAll() {
            // Crear la consulta para traer todas las ciudades
            $consulta = "SELECT * FROM ciudades";
            // Abrir la conexión a la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Crear un arreglo para guardar los registros de las ciudades
            $ciudades = array();
            // Obtener los registros uno por uno y guardarlos en una variable
            while ($ciudad = $resultado->fetch_assoc()) {
                $ciudades[] = $ciudad;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado (lista de ciudades)
            return $ciudades;
        }

        // Método para obtener una ciudad por su ID
        public function getById($id) {
            // Crear la consulta
            $consulta = "SELECT * FROM ciudades WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar que el ID traiga alguna respuesta
            if ($resultado && $resultado->num_rows > 0) {
                $ciudad = $resultado->fetch_assoc();
            } else {
                $ciudad = false;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar la ciudad o false si no se encontró
            return $ciudad;
        }

        // Método para eliminar una ciudad
        public function delete($id) {
            // Crear la consulta para eliminar una ciudad
            $consulta = "DELETE FROM ciudades WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la eliminación fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para insertar una nueva ciudad
        public function insert($ciudad) {
            // Crear la consulta para insertar una nueva ciudad
            $consulta = "INSERT INTO ciudades (nombre, estado) VALUES (
                '" . $ciudad['nombre'] . "',
                '" . $ciudad['estado'] . "'
            )";
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la inserción fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para editar una ciudad existente
        public function edit($ciudad) {
            // Crear la consulta para actualizar una ciudad existente
            $consulta = "UPDATE ciudades SET 
                nombre = '" . $ciudad['nombre'] . "',
                estado = '" . $ciudad['estado'] . "' 
                WHERE id = " . $ciudad['id'];
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la actualización fue exitosa, false en caso contrario
            return $respuesta;
        }
    }
?>
