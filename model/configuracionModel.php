<?php
    class ConfiguracionModel {
        // Atributo para la conexión a la base de datos
        private $DBConecction;

        // Constructor para conectar con la base de datos
        public function __construct() {
            // Solicitar la clase de conexión
            require_once("app/config/BDConecction.php");
            // Crear un objeto de la base de datos utilizando el atributo DBConecction
            $this->DBConecction = new BDConecction();
        }

        // Método para obtener todas las configuraciones
        public function getAll() {
            // Crear la consulta para traer todas las configuraciones
            $consulta = "SELECT * FROM configuracion";
            // Abrir la conexión a la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Crear un arreglo para guardar los registros de las configuraciones
            $configuraciones = array();
            // Obtener los registros uno por uno y guardarlos en una variable
            while ($configuracion = $resultado->fetch_assoc()) {
                $configuraciones[] = $configuracion;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado (lista de configuraciones)
            return $configuraciones;
        }

        // Método para obtener una configuración por su ID
        public function getById($id) {
            // Crear la consulta
            $consulta = "SELECT * FROM configuracion WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar si se encontró una configuración con el ID especificado
            if ($resultado && $resultado->num_rows > 0) {
                $configuracion = $resultado->fetch_assoc();
            } else {
                $configuracion = false;
            }
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar la configuración encontrada o false si no se encontró ninguna
            return $configuracion;
        }

        // Método para eliminar una configuración por su ID
        public function delete($id) {
            // Crear la consulta para eliminar una configuración
            $consulta = "DELETE FROM configuracion WHERE id = " . $id;
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar si la eliminación fue exitosa
            $respuesta = $resultado ? true : false;
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado de la eliminación
            return $respuesta;
        }

        // Método para insertar una nueva configuración
        public function insert($configuracion) {
            // Verificar que todos los campos necesarios están presentes
            if (!isset(
                $configuracion['propiedad1'], $configuracion['propiedad2'], $configuracion['propiedad3'], 
                $configuracion['propiedad4'], $configuracion['propiedad5'], $configuracion['propiedad6'], 
                $configuracion['oficina_central'], $configuracion['telefono1'], $configuracion['telefono2'], 
                $configuracion['email_contacto'], $configuracion['horarios'], $configuracion['mapa'], 
                $configuracion['facebook'], $configuracion['twitter'], $configuracion['tipo_visualizacion_propiedades'], 
                $configuracion['user'], $configuracion['password'], $configuracion['email_administrador']
            )) {
                return false;
            }
            // Crear la consulta para insertar una nueva configuración
            $consulta = "INSERT INTO configuracion (propiedad1, propiedad2, propiedad3, propiedad4, propiedad5, propiedad6, oficina_central, telefono1, telefono2, email_contacto, horarios, mapa, facebook, twitter, tipo_visualizacion_propiedades, user, password, email_administrador) VALUES (
                '" . $configuracion['propiedad1'] . "', '" . $configuracion['propiedad2'] . "', '" . $configuracion['propiedad3'] . "',
                '" . $configuracion['propiedad4'] . "', '" . $configuracion['propiedad5'] . "', '" . $configuracion['propiedad6'] . "',
                '" . $configuracion['oficina_central'] . "', '" . $configuracion['telefono1'] . "', '" . $configuracion['telefono2'] . "',
                '" . $configuracion['email_contacto'] . "', '" . $configuracion['horarios'] . "', '" . $configuracion['mapa'] . "',
                '" . $configuracion['facebook'] . "', '" . $configuracion['twitter'] . "', '" . $configuracion['tipo_visualizacion_propiedades'] . "',
                '" . $configuracion['user'] . "', '" . $configuracion['password'] . "', '" . $configuracion['email_administrador'] . "')";
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $resultado = $coneccion->query($consulta);
            // Verificar si la inserción fue exitosa
            $respuesta = $resultado ? true : false;
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado de la inserción
            return $respuesta;
        }

        // Método para editar una configuración existente
        public function edit($configuracion) {
            // Crear la consulta para actualizar una configuración existente
            $consulta = "UPDATE configuracion SET 
                propiedad1 = '" . $configuracion['propiedad1'] . "',
                propiedad2 = '" . $configuracion['propiedad2'] . "',
                propiedad3 = '" . $configuracion['propiedad3'] . "',
                propiedad4 = '" . $configuracion['propiedad4'] . "',
                propiedad5 = '" . $configuracion['propiedad5'] . "',
                propiedad6 = '" . $configuracion['propiedad6'] . "',
                oficina_central = '" . $configuracion['oficina_central'] . "',
                telefono1 = '" . $configuracion['telefono1'] . "',
                telefono2 = '" . $configuracion['telefono2'] . "',
                email_contacto = '" . $configuracion['email_contacto'] . "',
                horarios = '" . $configuracion['horarios'] . "',
                mapa = '" . $configuracion['mapa'] . "',
                facebook = '" . $configuracion['facebook'] . "',
                twitter = '" . $configuracion['twitter'] . "',
                tipo_visualizacion_propiedades = '" . $configuracion['tipo_visualizacion_propiedades'] . "',
                user = '" . $configuracion['user'] . "',
                password = '" . $configuracion['password'] . "',
                email_administrador = '" . $configuracion['email_administrador'] . "'
                WHERE id = " . $configuracion['id'];
            // Conectar con la base de datos
            $coneccion = $this->DBConecction->getConeccion();
            // Ejecutar la consulta
            $respuesta = $coneccion->query($consulta);
            // Cerrar la conexión a la base de datos
            $this->DBConecction->closeConeccion();
            // Retornar el resultado de la edición
            return $respuesta;
        }
    }
?>

