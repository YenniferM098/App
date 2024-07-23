<?php
    // Incluir el archivo del modelo FotosModel
    include_once("app/model/FotosModel.php");

    class FotosController {
        // Atributo para mantener la instancia del modelo
        private $fotosModel;

        // Método para manejar la acción predeterminada (listar todas las fotos de una propiedad)
        public function index() {
            // Instanciar el modelo
            $this->fotosModel = new FotosModel();
            // Obtener todas las fotos desde el modelo (suponiendo que se pasa un ID de propiedad)
            $id_propiedad = isset($_GET['id_propiedad']) ? $_GET['id_propiedad'] : 0;
            $datos = $this->fotosModel->getAll($id_propiedad);
            // Especificar el archivo de vista que se va a cargar
            $vista = "app/view/admin/fotos/fotoIndexView.php";
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

        // Método para manejar la eliminación de una foto
        public function delete() {
            // Verificar si el método de solicitud es GET
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Obtener el ID de la foto desde la cadena de consulta
                $id = $_GET['id'];
                // Instanciar el modelo
                $this->fotosModel = new FotosModel();
                // Llamar al método delete en el modelo
                $respuesta = $this->fotosModel->delete($id);
                // Redirigir según el resultado de la eliminación
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=FotosController&M=index&id_propiedad=" . $_GET['id_propiedad']);
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        // Método para llamar al formulario de inserción de una nueva foto
        public function callInsertForm() {
            // Iniciar la sesión
            session_start();
            // Verificar si el usuario ha iniciado sesión
            if (isset($_SESSION['logedin']) && $_SESSION['logedin'] == true) {
                // Especificar el archivo de vista que se va a cargar
                $vista = "App/view/admin/fotos/insertForm.php";
                include_once("App/view/admin/plantillaView.php");
            } else {
                // Si no ha iniciado sesión, redirigir al formulario de inicio de sesión
                header("location:http://localhost/php-3a/?C=UsuarioController&M=callFormLogin");
            }
        }

        // Método para manejar la inserción de una nueva foto
        public function insert() {
            // Verificar si el método de solicitud es POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Crear un array con los datos de la foto desde el formulario
                $foto = array(
                    'id_propiedad' => $_POST['id_propiedad'],
                    'nombre_foto' => $_POST['nombre_foto']
                );
                // Instanciar el modelo
                $this->fotosModel = new FotosModel();
                // Llamar al método insert en el modelo
                $resultado = $this->fotosModel->insert($foto);
                // Redirigir según el resultado de la inserción
                if ($resultado) {
                    header("location:http://localhost/php-3a/?C=FotosController&M=index&id_propiedad=" . $_POST['id_propiedad']);
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }

        // Método para llamar al formulario de edición de una foto
        public function callFormEdit() {
            // Verificar si el método de solicitud es GET
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                // Obtener el ID de la foto desde la cadena de consulta
                $id = $_GET['id'];
                // Instanciar el modelo
                $this->fotosModel = new FotosModel();
                // Obtener los datos de la foto por ID
                $datos = $this->fotosModel->getById($id);
                $vista = "app/view/admin/fotos/editForm.php";
                include_once("app/view/admin/plantillaView.php");
            }
        }

        public function edit() {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $foto = array(
                    'id' => $_POST['id'],
                    'id_propiedad' => $_POST['id_propiedad'],
                    'nombre_foto' => $_POST['nombre_foto']
                );
                $this->fotosModel = new FotosModel();
                $respuesta = $this->fotosModel->edit($foto);
                if ($respuesta) {
                    header("location:http://localhost/php-3a/?C=FotosController&M=index&id_propiedad=" . $_POST['id_propiedad']);
                } else {
                    header("location:http://localhost/php-3a");
                }
            }
        }
    }
?>
