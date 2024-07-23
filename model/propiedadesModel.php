<?php
    class PropiedadModel {
        // Atributo para la conexión a la base de datos
        private $DBConecction;

        // Constructor para conectar con la base de datos
        public function __construct() {
            // Solicitar la clase de conexión
            require_once("app/config/BDConecction.php");
            // Crear un objeto de la base de datos utilizando el atributo DBConecction
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todas las propiedades
        public function getAll() {
            // Crear la consulta para traer todas las propiedades
            $consulta = "SELECT * FROM propiedades";
            // Abrir la conexión a la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Crear un arreglo para guardar los registros de las propiedades
            $propiedades = array();
            // Obtener los registros uno por uno y guardarlos en una variable
            while ($propiedad = $resultado->fetch_assoc()) {
                $propiedades[] = $propiedad;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado (lista de propiedades)
            return $propiedades;
        }

        // Método para obtener una propiedad por su ID
        public function getById($id) {
            // Crear la consulta
            $consulta = "SELECT * FROM propiedades WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar que el ID traiga alguna respuesta
            if ($resultado && $resultado->num_rows > 0) {
                $propiedad = $resultado->fetch_assoc();
            } else {
                $propiedad = false;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar la propiedad o false si no se encontró
            return $propiedad;
        }

        // Método para eliminar una propiedad
        public function delete($id) {
            // Crear la consulta para eliminar una propiedad
            $consulta = "DELETE FROM propiedades WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar true si la eliminación fue exitosa, false en caso contrario
            return $respuesta;
        }

        // Método para insertar una nueva propiedad
        public function insert($propiedad) {
            // Crear la consulta para insertar una nueva propiedad
            $consulta = "INSERT INTO propiedades (fecha_alta, titulo, descripcion, tipo, ubicacion, habitaciones, banios, pisos, garage, dimensiones, precio, url_foto_principal, estado, ciudad, propietario, telefono_propietario) VALUES (
                '" . $propiedad['fecha_alta'] . "',
                '" . $propiedad['titulo'] . "',
                '" . $propiedad['descripcion'] . "',
                '" . $propiedad['tipo'] . "',
                '" . $propiedad['ubicacion'] . "',
                '" . $propiedad['habitaciones'] . "',
                '" . $propiedad['banios'] . "',
                '" . $propiedad['pisos'] . "',
                '" . $propiedad['garage'] . "',
                '" . $propiedad['dimensiones'] . "',
                '" . $propiedad['precio'] . "',
                '" . $propiedad['url_foto_principal'] . "',
                '" . $propiedad['estado'] . "',
                '" . $propiedad['ciudad'] . "',
                '" . $propiedad['propietario'] . "',
                '" . $propiedad['telefono_propietario'] . "'
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

        // Método para editar una propiedad existente
        public function edit($propiedad) {
            // Crear la consulta para actualizar una propiedad existente
            $consulta = "UPDATE propiedades SET 
                fecha_alta = '" . $propiedad['fecha_alta'] . "',
                titulo = '" . $propiedad['titulo'] . "',
                descripcion = '" . $propiedad['descripcion'] . "',
                tipo = '" . $propiedad['tipo'] . "',
                ubicacion = '" . $propiedad['ubicacion'] . "',
                habitaciones = '" . $propiedad['habitaciones'] . "',
                banios = '" . $propiedad['banios'] . "',
                pisos = '" . $propiedad['pisos'] . "',
                garage = '" . $propiedad['garage'] . "',
                dimensiones = '" . $propiedad['dimensiones'] . "',
                precio = '" . $propiedad['precio'] . "',
                url_foto_principal = '" . $propiedad['url_foto_principal'] . "',
                estado = '" . $propiedad['estado'] . "',
                ciudad = '" . $propiedad['ciudad'] . "',
                propietario = '" . $propiedad['propietario'] . "',
                telefono_propietario = '" . $propiedad['telefono_propietario'] . "' 
                WHERE id = " . $propiedad['id'];
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
