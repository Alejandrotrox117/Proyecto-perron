<?php 
    class Controllers
    {
        public function __construct(){
            $this -> load_model();
            $this -> views = new Views();
        }

        public function load_model(){
            $model = get_class($this)."Model";
            //ruta del archivo
            $routeClass = "models/".$model.".php";
            //validamos si el archivo existe
            if(file_exists($routeClass)){
                require_once($routeClass);
                //instanciamos la clase
                $modelObject = new $model();
                return $modelObject;
            }
        }
    }
?>