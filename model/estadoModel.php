<?php
    class EstadoModel {
        // Atributo para la conexión a la base de datos
        private $DBConecction;

        // Constructor para conectar con la base de datos
        public function __construct() {
            // Solicitar la clase de conexión
            require_once("app/config/BDConecction.php");
            // Crear un objeto de la base de datos utilizando el atributo DBConecction
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todos los estados
        public function getAll() {
            // Crear la consulta para traer todos los estados
            $consulta = "SELECT * FROM estados";
            // Abrir la conexión a la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Crear un arreglo para guardar los registros de los estados
            $estados = array();
            // Obtener los registros uno por uno y guardarlos en una variable
            while ($estado = $resultado->fetch_assoc()) {
                $estados[] = $estado;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado (lista de estados)
            return $estados;
        }

        // Método para obtener un estado por su ID
        public function getById($id) {
            // Crear la consulta
            $consulta = "SELECT * FROM estados WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar que el ID traiga alguna respuesta
            if ($resultado && $resultado->num_rows > 0) {
                $estado = $resultado->fetch_assoc();
            } else {
                $estado = false;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el estado o false si no se encontró
            return $estado;
        }

        // Método para eliminar un estado
        public function delete($id) {
            // Crear la consulta para eliminar un estado
            $consulta = "DELETE FROM estados WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la eliminación fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para insertar un nuevo estado
        public function insert($estado) {
            // Crear la consulta para insertar un nuevo estado
            $consulta = "INSERT INTO estados (nombre_estado) VALUES (
                '" . $estado['nombre'] . "'
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

        // Método para editar un estado existente
        public function edit($estado) {
            // Crear la consulta para actualizar un estado existente
            $consulta = "UPDATE estados SET 
                nombre_estado = '" . $estado['nombre'] . "' 
                WHERE id = " . $estado['id'];
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
