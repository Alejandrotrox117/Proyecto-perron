<?php
class Usuarios extends Controllers 
{
    public function __construct(){
        parent::__construct();
        
    }

    public function Usuarios()
    {
    $data ['page_id']= 8 ;
    $data['page_tag'] = "usuarios";
    $data['page_title'] = "USUARIOS <small>Tienda Virtual</small>";
    $data['page_name'] = "usuarios";
    $this->views->getView($this, "usuarios", $data);
    }

    

}   
?>