<?php
class Roles extends Controllers 
{
    public function __construct(){
        parent::__construct();
        
    }

    public function roles($params){
        $data ['page_id']= 4 ;
        $data['page_tag'] = "Roles de Usuarios";
        $data['page_title'] = "Roles de Usuarios";
        $data['page_name']="Roles de usuarios";

        $this->views->getView($this,"roles",$data);
    }

    

}   
?>