<?php
    // Incluir el archivo del modelo TiposModel
    include_once("app/model/TiposModel.php");

    class TiposController {
        private $tiposModel;

        // Método para manejar la acción predeterminada (listar todos los tipos)
        public function index() {
            $this->tiposModel = new TiposModel();
            $datos = $this->tiposModel->getAll();
            $vista = "app/view/admin/tipos/tipoIndexView.php";
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
                $this->tiposModel = new TiposModel();
                $respuesta = $this->tiposModel->delete($id);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=TiposController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        // Método para llamar al formulario de inserción de un nuevo tipo
        public function callInsertForm() {
            // Iniciar la sesión
            session_start();
            // Verificar si el usuario ha iniciado sesión
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                // Especificar el archivo de vista que se va a cargar
                $vista = "App/view/admin/tipos/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        // Método para manejar la inserción de un nuevo tipo
        public function insert() {
            // Verificar si el método de solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Crear un array con los datos del tipo desde el formulario
                $tipo = array(
                    'nombre_tipo' => $_POST['nombre_tipo']
                );
                // Instanciar el modelo
                $this->tiposModel = new TiposModel();
                // Llamar al método insert en el modelo
                $resultado = $this->tiposModel->insert($tipo);
                // Redirigir según el resultado de la inserción
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=TiposController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        // Método para llamar al formulario de edición de un tipo
        public function callFormEdit() {
            // Verificar si el método de solicitud es GET
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Obtener el ID del tipo desde la cadena de consulta
                $id = $_GET['id'];
                // Instanciar el modelo
                $this->tiposModel = new TiposModel();
                // Obtener los datos del tipo por ID
                $datos = $this->tiposModel->getById($id);
                // Especificar el archivo de vista que se va a cargar
                $vista = "app/view/admin/tipos/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        // Método para manejar la edición de un tipo existente
        public function edit() {
            // Verificar si el método de solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Crear un array con los datos del tipo desde el formulario
                $tipo = array(
                    'id' => $_POST['id'],
                    'nombre_tipo' => $_POST['nombre_tipo']
                );
                // Instanciar el modelo
                $this->tiposModel = new TiposModel();
                // Llamar al método edit en el modelo
                $respuesta = $this->tiposModel->edit($tipo);
                // Redirigir según el resultado de la edición
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=TiposController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>

