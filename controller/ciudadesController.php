<?php
    // Incluir el archivo del modelo CiudadModel
    include_once("app/model/CiudadModel.php");

    class CiudadController {
        private $ciudadModel;

        public function index() {
            $this->ciudadModel = new CiudadModel();
            $datos = $this->ciudadModel->getAll();
            $vista = "app/view/admin/ciudades/ciudadIndexView.php";

            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                include_once("app/view/admin/plantillaView.php");
            } else {
                $vista = "app/view/admin/usuarios/formLoginView.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        public function delete() {

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->ciudadModel = new CiudadModel();
                $respuesta = $this->ciudadModel->delete($id);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=CiudadController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callInsertForm() {
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                $vista = "App/view/admin/ciudades/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {
                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        public function insert() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $ciudad = array(
                    'nombre' => $_POST['nombre'],
                    'estado' => $_POST['estado']
                );
                $this->ciudadModel = new CiudadModel();
                $resultado = $this->ciudadModel->insert($ciudad);
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=CiudadController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callFormEdit() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->ciudadModel = new CiudadModel();
                $datos = $this->ciudadModel->getById($id);
                $vista = "app/view/admin/ciudades/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        public function edit() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $ciudad = array(
                    'id' => $_POST['id'],
                    'nombre' => $_POST['nombre'],
                    'estado' => $_POST['estado']
                );

                $this->ciudadModel = new CiudadModel();
                $respuesta = $this->ciudadModel->edit($ciudad);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=CiudadController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>
