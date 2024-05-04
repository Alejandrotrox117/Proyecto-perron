<?php 
    class Controllers{
        public function __construct(){
            $this -> load_model();
        }

        public function load_model(){
            $model= get_class($this)."model";
            //ruta del archivo
            $routeClass= "models/".$model.".php";
            //validamos si el archivo existe
            if(file_exists($routeClass)){
                require_once($routeClass);
                //instanciamos la clase
                $this -> model = new $model();
            }
        }
    }
?>