<?php
    class PublicacionesModel {
        // Atributo para la conexión a la base de datos
        private $DBConecction;

        // Constructor para conectar con la base de datos
        public function __construct() {
            // Solicitar la clase de conexión
            require_once("app/config/BDConecction.php");
            // Crear un objeto de la base de datos utilizando el atributo DBConecction
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todas las publicaciones
        public function getAll() {
            // Crear la consulta para traer todas las publicaciones
            $consulta = "SELECT * FROM publicaciones";
            $coneccion = $this->DBConecction->getConeccion();
            $resultado = $coneccion->query($consulta);
            $publicaciones = array();
            while ($publicacion = $resultado->fetch_assoc()) {
                $publicaciones[] = $publicacion;
            }
            $this->DBConecction->closeConeccion();
            return $publicaciones;
        }

        // Método para obtener una publicación por su ID
        public function getById($id) {
            // Crear la consulta
            $consulta = "SELECT * FROM publicaciones WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar que el ID traiga alguna respuesta
            if ($resultado && $resultado->num_rows > 0) {
                $publicacion = $resultado->fetch_assoc();
            } else {
                $publicacion = false;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar la publicación o false si no se encontró
            return $publicacion;
        }

        // Método para eliminar una publicación
        public function delete($id) {
            // Crear la consulta para eliminar una publicación
            $consulta = "DELETE FROM publicaciones WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la eliminación fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para insertar una nueva publicación
        public function insert($publicacion) {
            // Crear la consulta para insertar una nueva publicación
            $consulta = "INSERT INTO publicaciones (titulo, descripcion, fecha_publicacion, autor) VALUES (
                '" . $publicacion['titulo'] . "',
                '" . $publicacion['descripcion'] . "',
                '" . $publicacion['fecha_publicacion'] . "',
                '" . $publicacion['autor'] . "'
            )";
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            $respuesta = $coneccion->query($consulta);
            $this->DBConecction->closeConeccion();
            return $respuesta;
        }

        public function edit($publicacion) {
            $consulta = "UPDATE publicaciones SET 
                titulo = '" . $publicacion['titulo'] . "',
                descripcion = '" . $publicacion['descripcion'] . "',
                fecha_publicacion = '" . $publicacion['fecha_publicacion'] . "',
                autor = '" . $publicacion['autor'] . "'
                WHERE id = " . $publicacion['id'];
            $coneccion = $this->DBConecction->getConeccion();
            $respuesta = $coneccion->query($consulta);
            $this->DBConecction->closeConeccion();
            return $respuesta;
        }
    }
?>
