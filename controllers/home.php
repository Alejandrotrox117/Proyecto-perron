<?php 
    class Home extends Controllers 
    {
        public function __construct(){
           //ejecutar el constructor del controlador
            parent::__construct();
            
        }
      
        public function home($params){
           $this ->views->getView($this,"home");
        }

    }


?>