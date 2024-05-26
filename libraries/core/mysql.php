<?php 
    class Mysql extends Conexion{
        private $conexion;
        private $query;
        private $arrValues;

        public function __construct(){
            $this->conexion = new Conexion();
            //invoca el metodo conect() de la clase Conexion
            $this->conexion = $this->conexion->conect();
            
        }

        public function insert(string $query,array $arrValues){
            $this -> query = $query;
            $this -> arrValues = $arrValues;
            $insert = $this -> conexion -> prepare($this -> query);
            $insert -> execute($this -> arrValues);
            if ($insert) {
                $lastInsert = $this -> conexion -> lastInsertId();
            }else{
                $lastInsert = 0;
            }
            return $lastInsert;
        }

        //funcion para consultar uno solo
        public function search(string $query){
            $this -> query = $query;
            $select = $this -> conexion -> prepare($this -> query);
            $select -> execute();
            $data=$select->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        //funcion para consultar todos
        public function searchAll(string $query){
            $this -> query = $query;
            $select = $this -> conexion -> prepare($this -> query);
            $select -> execute();
            $data=$select->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }

        //actualizar un registro
        public function update(string $query,array $arrValues){
            $this -> query = $query;
            $this -> arrValues = $arrValues;
            $update = $this -> conexion -> prepare($this -> query);
            $execute = $update -> execute($this -> arrValues);
            return $execute;
        } 

        //funcion para eliminar un registro
        public function delete(string $query){
            $this -> query = $query;
            $delete = $this -> conexion -> prepare($this -> query);
            $delete -> execute();
            return $delete;
        }




}




?>