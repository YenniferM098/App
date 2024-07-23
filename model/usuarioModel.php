<?php
include_once("app/config/BDConnection.php");

class UsuarioModel {
    private $db;
    private $conn;

    public function __construct() {
        $this->db = new BDConnection();
        $this->conn = $this->db->getConnection();
    }

    public function getCredentials($email, $password) {
        $query = "SELECT user FROM configuracion WHERE email_administrador = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }
}
?>
