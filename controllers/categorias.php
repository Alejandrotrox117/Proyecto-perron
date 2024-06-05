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
        if(isset($_POST['enviar'])){
            if(empty($_POST['txtNombre']) || empty($_POST['txtDescripcion']) ||empty($_POST['listStatus'])){
                $arrResponse = array('status' => false, 'msg' => 'Datos incorrectos.');  
            }
        }else{
            $intidCategoria = intval($_POST['idCategoria']);
            $strNombre = strClean($_POST['txtNombre']);
            $strDescripcion = strClean($_POST['txtDescripcion']);
            $intStatus = intval($_POST['listEstatus']);

            $foto = $_FILES['foto'];
            $nombre_foto = $foto['name'];
            $type = $foto['type'];
            $url = $foto['tmp_name'];
            $fecha = date('ymd');
            $hora = date('Hms');
            $imgPortada = 'categorias.png';

            if($nombre_foto != ''){
                $imgPortada = 'img_'.md5(date('d-m-Y H:m:s')).'.jpg';
            }

            if($intidCategoria == 0){
                $request_categoria = $this->model->insertCategoria($strNombre, $strDescripcion, $intStatus, $imgPortada);
                if(is_numeric($request_categoria) && $request_categoria > 0){
                    $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
                    if($nombre_foto != ''){uploadImage($foto, $imgPortada);}
                }else if($request_categoria === "exist"){
                    $arrResponse = array('status' => false, 'msg' => 'Categoria ya existe.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }else{
                if(is_numeric($request_categoria) && $request_categoria > 0){
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                }else if($request_categoria === "exist"){
                    $arrResponse = array('status' => false, 'msg' => 'Categoria ya existe.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
                }
            }
        }
    }
}
   
?>