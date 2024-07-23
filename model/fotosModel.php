<?php
    class FotosModel {
        // Atributo para la conexión a la base de datos
        private $DBConecction;

        // Constructor para conectar con la base de datos
        public function __construct() {
            // Solicitar la clase de conexión
            require_once("app/config/BDConecction.php");
            // Crear un objeto de la base de datos utilizando el atributo DBConecction
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todas las fotos de una propiedad
        public function getAll($id_propiedad) {
            // Crear la consulta para traer todas las fotos de una propiedad específica
            $consulta = "SELECT * FROM fotos WHERE id_propiedad = " . $id_propiedad;
            // Abrir la conexión a la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Crear un arreglo para guardar los registros de las fotos
            $fotos = array();
            // Obtener los registros uno por uno y guardarlos en una variable
            while ($foto = $resultado->fetch_assoc()) {
                $fotos[] = $foto;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado (lista de fotos)
            return $fotos;
        }

        // Método para obtener una foto por su ID
        public function getById($id) {
            // Crear la consulta
            $consulta = "SELECT * FROM fotos WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar que el ID traiga alguna respuesta
            if ($resultado && $resultado->num_rows > 0) {
                $foto = $resultado->fetch_assoc();
            } else {
                $foto = false;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar la foto o false si no se encontró
            return $foto;
        }

        // Método para eliminar una foto
        public function delete($id) {
            // Crear la consulta para eliminar una foto
            $consulta = "DELETE FROM fotos WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la eliminación fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para insertar una nueva foto
        public function insert($foto) {
            // Crear la consulta para insertar una nueva foto
            $consulta = "INSERT INTO fotos (id_propiedad, nombre_foto) VALUES (
                " . $foto['id_propiedad'] . ",
                '" . $foto['nombre_foto'] . "'
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

        // Método para editar una foto existente
        public function edit($foto) {
            // Crear la consulta para actualizar una foto
            $consulta = "UPDATE fotos SET 
                id_propiedad = " . $foto['id_propiedad'] . ",
                nombre_foto = '" . $foto['nombre_foto'] . "'
                WHERE id = " . $foto['id'];
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la edición fue exitosa, false en caso contrario
            return $respuesta;
        }
    }
?>

