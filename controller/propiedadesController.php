<?php
    // Incluir el archivo del modelo PropiedadModel
    include_once("app/model/PropiedadModel.php");

    class PropiedadController {
        private $propiedadModel;

        // listar todas las propiedades
        public function index() {
            $this->propiedadModel = new PropiedadModel();
            $datos = $this->propiedadModel->getAll();
            $vista = "app/view/admin/propiedades/propiedadIndexView.php";
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
                $this->propiedadModel = new PropiedadModel();
                $respuesta = $this->propiedadModel->delete($id);
       
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=PropiedadController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callInsertForm() {
            session_start();
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                $vista = "App/view/admin/propiedades/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión mandar al formulario de inicio de sesión
                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        public function insert() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $propiedad = array(
                    'fecha_alta' => $_POST['fecha_alta'],
                    'titulo' => $_POST['titulo'],
                    'descripcion' => $_POST['descripcion'],
                    'tipo' => $_POST['tipo'],
                    'ubicacion' => $_POST['ubicacion'],
                    'habitaciones' => $_POST['habitaciones'],
                    'banios' => $_POST['banios'],
                    'pisos' => $_POST['pisos'],
                    'garage' => $_POST['garage'],
                    'dimensiones' => $_POST['dimensiones'],
                    'precio' => $_POST['precio'],
                    'url_foto_principal' => $_POST['url_foto_principal'],
                    'estado' => $_POST['estado'],
                    'ciudad' => $_POST['ciudad'],
                    'propietario' => $_POST['propietario'],
                    'telefono_propietario' => $_POST['telefono_propietario']
                );
                $this->propiedadModel = new PropiedadModel();
                $resultado = $this->propiedadModel->insert($propiedad);
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=PropiedadController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callFormEdit() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->propiedadModel = new PropiedadModel();
                $datos = $this->propiedadModel->getById($id);
                $vista = "app/view/admin/propiedades/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        public function edit() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $propiedad = array(
                    'id' => $_POST['id'],
                    'fecha_alta' => $_POST['fecha_alta'],
                    'titulo' => $_POST['titulo'],
                    'descripcion' => $_POST['descripcion'],
                    'tipo' => $_POST['tipo'],
                    'ubicacion' => $_POST['ubicacion'],
                    'habitaciones' => $_POST['habitaciones'],
                    'banios' => $_POST['banios'],
                    'pisos' => $_POST['pisos'],
                    'garage' => $_POST['garage'],
                    'dimensiones' => $_POST['dimensiones'],
                    'precio' => $_POST['precio'],
                    'url_foto_principal' => $_POST['url_foto_principal'],
                    'estado' => $_POST['estado'],
                    'ciudad' => $_POST['ciudad'],
                    'propietario' => $_POST['propietario'],
                    'telefono_propietario' => $_POST['telefono_propietario']
                );

                $this->propiedadModel = new PropiedadModel();
                $respuesta = $this->propiedadModel->edit($propiedad);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=PropiedadController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>
