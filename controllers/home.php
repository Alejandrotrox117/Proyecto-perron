<?php 
    class Home extends Controllers 
    {
        public function __construct(){
           //ejecutar el constructor del controlador
            parent::__construct();
            
        }
      
        public function home($params){
            $data["page_title"] = "Pagina principal";
            $data["tag_page"]="Home";
            $data["page_name"]="Home";
           $this ->views->getView($this,"home",$data);
        }

    }


?>