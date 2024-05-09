<?php 
    class Mysql extends Conexion{
        private $conexion;
        private $query;
        private $arrValues;

        public function __construct(){
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->connect();
            
        }

        public function insert(string $query,array $arrValues){
        
        
        
        }







}




?>