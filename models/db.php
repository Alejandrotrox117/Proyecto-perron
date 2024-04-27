<?php
    class Database {
        private $ip = "localhost"; 
        private $nombre = "celtech";
        private $usuario = "root"; 
        private $contrasena = ""; // <-----[Contrasena] Cambiar si es necesario-----
        private $connect; // Variable para almacenar la conexión


        public function __construct() {
            $this->connect = new PDO("mysql:host=".$this->ip.";dbname=".$this->nombre."",$this->usuario,$this->contrasena); // Nueva conexión pdo a la bd
            $this->connect->exec("set names utf8"); // Caracteres a UTF-8
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Excepciones
        }

        public function sqlQuery($query) {
            return $this->connect->query($query); // Consulta sql, devuelve resultado
        }

        public function connectBD() {
            $connect = new PDO("mysql:host=".$this->ip.";dbname=".$this->nombre."",$this->usuario,$this->contrasena); // Nueva conexión pdo a la bd
            $connect->exec("set names utf8");
            return $connect; // Return la conexión a la bd
        }
    }
?>