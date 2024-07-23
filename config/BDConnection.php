<?php
    //creamos la clase para gestionar la coneccion 
    class BDConecction{
        //creamos un atributo "$connction" para manipular nuestra base de datos 
        private $conecction;      

        //definimos el constructor de nuestra clase 
        //en este conectamos con la base de datos
        public function __construct(){
            //requerimos las constantes de coneccion a nuestra base de datos 
            require_once('app/config/config.php');
            //creamos la coneccion a nuestra base de datos 
            $this->conecction = new mysqli(BD_HOST,BD_USER,BD_PASSWORD,BD_NAME);
            //verificamos que no existan errores al conectar
            if($this->conecction->connect_error){
                die('Error al conectar con la base de datos Descripcion : '. $this->conecction->connect_error);
            }
        }

        //metodo de coneccion a la base de datos
        public function getConeccion(){
            return $this->conecction;
        }

        //metodo para cerrar la base de datos
        public function closeConeccion(){
            $this->conecction->close();
        }
    }
?>