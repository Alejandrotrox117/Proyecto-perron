<?php
class Dashboard extends Controllers 
{
    public function __construct(){
        parent::__construct();
        
    }

    public function dashboard($params){
        $data ['page_id']= 3 ;
        $data['page_tag'] = "Dashboard";
        $data['page_title'] = "Dashboard";
        $data['page_name']="dashboard";
     
        $data['categorias']= $this->model->Cantcategorias();
        $data['rol']= $this->model->Cantrol();
        $data['ultimasOrde']= $this->model->UltimasOrdes();
        //dep($ultimasOrde);exit; 

        $this->views->getView($this,"dashboard",$data);
    }

    

}   
?>