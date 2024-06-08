<?php
class Productos extends Controllers 
{
    public function __construct(){
        parent::__construct();
        
    }

    public function Productos($params){
        $data ['page_id']= 6 ;
        $data['page_tag'] = "Productos";
        $data['page_title'] = "Productos <small>Tienda Virtual</small>";
        $data['page_name']="productos";
        $data['page_functions_js']="functions_productos.js";

        $this->views->getView($this,"productos",$data);
    }

}
   
?>