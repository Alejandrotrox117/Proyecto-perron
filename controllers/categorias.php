<?php
class Categorias extends Controllers 
{
    public function __construct(){
        parent::__construct();
        
    }

    public function categorias($params){
        $data ['page_id']= 6 ;
        $data['page_tag'] = "Categorias";
        $data['page_title'] = "Categorias <small>Tienda Virtual</small>";
        $data['page_name']="categorias";
        $data['page_functions_js']="functions_categorias.js";

        $this->views->getView($this,"categorias",$data);
    }

    public function setCategoria(){

        $intidCategoria = intval($_POST['idCategoria']);
        $strNombre = strClean($_POST['txtNombre']);
        $strDescripcion = strClean($_POST['txtDescripcion']);
        $intStatus = intval($_POST['listEstatus']);
        $request_categoria = $this->model->insertCategoria($strNombre, $strDescripcion, $intStatus);
       
        if(is_numeric($request_categoria) && $request_categoria > 0){
            $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
        }else if($request_categoria === "exist"){
            $arrResponse = array('status' => false, 'msg' => 'Categoria ya existe.');
        }else{
            $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
        }
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        die();
    }
}
   
?>