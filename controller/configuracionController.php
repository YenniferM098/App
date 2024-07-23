<?php

    include_once("app/model/ConfiguracionModel.php");

    class ConfiguracionController {
        private $configuracionModel;

        public function index() {
            $this->configuracionModel = new ConfiguracionModel();
            $datos = $this->configuracionModel->getAll();
            $vista = "app/view/admin/configuracion/configuracionIndexView.php";

            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                include_once("app/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión, redirigir al formulario de inicio 
                $vista = "app/view/admin/usuarios/formLoginView.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        public function delete() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->configuracionModel = new ConfiguracionModel();
                $respuesta = $this->configuracionModel->delete($id);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=ConfiguracionController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callInsertForm() {
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                $vista = "App/view/admin/configuracion/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {

                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        public function insert() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $configuracion = array(
                    'propiedad1' => $_POST['propiedad1'],
                    'propiedad2' => $_POST['propiedad2'],
                    'propiedad3' => $_POST['propiedad3'],
                    'propiedad4' => $_POST['propiedad4'],
                    'propiedad5' => $_POST['propiedad5'],
                    'propiedad6' => $_POST['propiedad6'],
                    'oficina_central' => $_POST['oficina_central'],
                    'telefono1' => $_POST['telefono1'],
                    'telefono2' => $_POST['telefono2'],
                    'email_contacto' => $_POST['email_contacto'],
                    'horarios' => $_POST['horarios'],
                    'mapa' => $_POST['mapa'],
                    'facebook' => $_POST['facebook'],
                    'twitter' => $_POST['twitter'],
                    'tipo_visualizacion_propiedades' => $_POST['tipo_visualizacion_propiedades'],
                    'user' => $_POST['user'],
                    'password' => $_POST['password'],
                    'email_administrador' => $_POST['email_administrador']
                );
                $this->configuracionModel = new ConfiguracionModel();
                $resultado = $this->configuracionModel->insert($configuracion);
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=ConfiguracionController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callFormEdit() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->configuracionModel = new ConfiguracionModel();
                $datos = $this->configuracionModel->getById($id);
                $vista = "app/view/admin/configuracion/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        public function edit() {
            // Verificar si el método de solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $configuracion = array(
                    'id' => $_POST['id'],
                    'propiedad1' => $_POST['propiedad1'],
                    'propiedad2' => $_POST['propiedad2'],
                    'propiedad3' => $_POST['propiedad3'],
                    'propiedad4' => $_POST['propiedad4'],
                    'propiedad5' => $_POST['propiedad5'],
                    'propiedad6' => $_POST['propiedad6'],
                    'oficina_central' => $_POST['oficina_central'],
                    'telefono1' => $_POST['telefono1'],
                    'telefono2' => $_POST['telefono2'],
                    'email_contacto' => $_POST['email_contacto'],
                    'horarios' => $_POST['horarios'],
                    'mapa' => $_POST['mapa'],
                    'facebook' => $_POST['facebook'],
                    'twitter' => $_POST['twitter'],
                    'tipo_visualizacion_propiedades' => $_POST['tipo_visualizacion_propiedades'],
                    'user' => $_POST['user'],
                    'password' => $_POST['password'],
                    'email_administrador' => $_POST['email_administrador']
                );
                $this->configuracionModel = new ConfiguracionModel();
                $respuesta = $this->configuracionModel->edit($configuracion);

                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=ConfiguracionController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>
