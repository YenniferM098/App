<?php
    // Incluir el archivo del modelo EstadoModel
    include_once("app/model/EstadoModel.php");

    class EstadoController {

        private $estadoModel;

      //listar  los estados
        public function index() {
            $this->estadoModel = new EstadoModel();
            $datos = $this->estadoModel->getAll();
            $vista = "app/view/admin/estados/estadoIndexView.php";
            session_start();
            // Verificar si el usuario ha iniciado sesión
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
                $this->estadoModel = new EstadoModel();

                $respuesta = $this->estadoModel->delete($id);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=EstadoController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callInsertForm() {
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                $vista = "App/view/admin/estados/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión redirigir al formulario de inicio de sesión
                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        public function insert() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $estado = array(
                    'nombre' => $_POST['nombre']
                );
                $this->estadoModel = new EstadoModel();
                $resultado = $this->estadoModel->insert($estado);
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=EstadoController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callFormEdit() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->estadoModel = new EstadoModel();
                $datos = $this->estadoModel->getById($id);
                $vista = "app/view/admin/estados/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }


        public function edit() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $estado = array(
                    'id' => $_POST['id'],
                    'nombre' => $_POST['nombre']
                );
                $this->estadoModel = new EstadoModel();
                $respuesta = $this->estadoModel->edit($estado);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=EstadoController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>
