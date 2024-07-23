<?php
    // Incluir el archivo del modelo PublicacionesModel
    include_once("app/model/PublicacionesModel.php");

    class PublicacionesController {
        // Atributo para mantener la instancia del modelo
        private $publicacionesModel;

        // Método para manejar la acción predeterminada (listar todas las publicaciones)
        public function index() {
            // Instanciar el modelo
            $this->publicacionesModel = new PublicacionesModel();
            // Obtener todas las publicaciones desde el modelo
            $datos = $this->publicacionesModel->getAll();
            // Especificar el archivo de vista que se va a cargar
            $vista = "app/view/admin/publicaciones/publicacionIndexView.php";
            // Iniciar la sesión
            session_start();
            // Verificar si el usuario ha iniciado sesión
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                // Incluir la plantilla principal de la vista
                include_once("app/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
                $vista = "app/view/admin/usuarios/formLoginView.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        // Método para manejar la eliminación de una publicación
        public function delete() {
            // Verificar si el método de solicitud es GET
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Obtener el ID de la publicación desde la cadena de consulta
                $id = $_GET['id'];
                // Instanciar el modelo
                $this->publicacionesModel = new PublicacionesModel();
                // Llamar al método delete en el modelo
                $respuesta = $this->publicacionesModel->delete($id);
                // Redirigir según el resultado de la eliminación
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=PublicacionesController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        // Método para llamar al formulario de inserción de una nueva publicación
        public function callInsertForm() {
            // Iniciar la sesión
            session_start();
            // Verificar si el usuario ha iniciado sesión
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                // Especificar el archivo de vista que se va a cargar
                $vista = "App/view/admin/publicaciones/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        // Método para manejar la inserción de una nueva publicación
        public function insert() {
            // Verificar si el método de solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Crear un array con los datos de la publicación desde el formulario
                $publicacion = array(
                    'titulo' => $_POST['titulo'],
                    'descripcion' => $_POST['descripcion'],
                    'fecha_publicacion' => $_POST['fecha_publicacion'],
                    'autor' => $_POST['autor']
                );
                // Instanciar el modelo
                $this->publicacionesModel = new PublicacionesModel();
                // Llamar al método insert en el modelo
                $resultado = $this->publicacionesModel->insert($publicacion);
                // Redirigir según el resultado de la inserción
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=PublicacionesController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        public function callFormEdit() {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                $id = $_GET['id'];
                $this->publicacionesModel = new PublicacionesModel();
                $datos = $this->publicacionesModel->getById($id);
                $vista = "app/view/admin/publicaciones/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        // Método para manejar la edición de una publicación existente
        public function edit() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $publicacion = array(
                    'id' => $_POST['id'],
                    'titulo' => $_POST['titulo'],
                    'descripcion' => $_POST['descripcion'],
                    'fecha_publicacion' => $_POST['fecha_publicacion'],
                    'autor' => $_POST['autor']
                );
                $this->publicacionesModel = new PublicacionesModel();
                $respuesta = $this->publicacionesModel->edit($publicacion);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=PublicacionesController&M=index");
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>
