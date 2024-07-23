<?php
    class defaultController{
        private $vista;

        public function index(){
            $vista="app/view/admin/adminHomeView.php";
            session_start();
            if(isset($_SESSION['logedin']) && $_SESSION['logedin']==true ){
                echo $_SESSION['logedin'];
                include_once("app/view/admin/plantillaView.php");
            }else{
                include_once("app/view/admin/plantilla2View.php");
            }
        }

    }
?>