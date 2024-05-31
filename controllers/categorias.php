<?php
class Categorias extends Controllers 
{
    public function __construct(){
        parent::__construct();
        
    }

    public function categorias($params){
        $data ['page_id']= 6 ;
        $data['page_tag'] = "Categorias";
        $data['page_title'] = "CATEGORIAS <small>Tienda Virtual</small>";
        $data['page_name']="categorias";
        ///$data['page_functions_js']="functions_categorias.js";

        $this->views->getView($this,"categorias",$data);
    }

}   
?>