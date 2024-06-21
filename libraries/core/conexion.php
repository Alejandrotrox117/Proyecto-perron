<?php 
class Conexion {
    private $conect;

    public function __construct() {
        $connectionString="mysql:host=".DB_HOST.";dbname=".DB_NAME.";.DB_CHARSET.";
        try {
            $this->conect = new PDO($connectionString, DB_USER, DB_PASSWORD);
            // Configurar la conexión para que lance excepciones en caso de error
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Mostrar el error en el log o enviar un correo electrónico
            error_log("Error de conexión a la base de datos: " . $e->getMessage());
            // Puedes mostrar un mensaje de error al usuario
            echo "Error de conexión a la base de datos.";
            // O lanzar una excepción personalizada
            throw new Exception("Error de conexión a la base de datos.");
        } 
    }

    public function connect() {
        return $this->conect;
    }
}
?>