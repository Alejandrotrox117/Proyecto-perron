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

    
    public function getProductos(){
        $arrData = $this->model->selectProductos();
    
        for ($i=0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estado'] == 1) {
                $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }
    
            $arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);
    
            $arrData[$i]['acciones'] = '<div class="text-center">
            <button class="btn btn-warning btn-sm" onClick="btnViewInfo('.$arrData[$i]['productoId'].')" title="Ver"><i class="fas fa-eye"></i></button>
            <button class="btn btn-warning btn-sm" onClick="btnEditInfo(this,'.$arrData[$i]['productoId'].')" title="Editar"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onClick="btnDeleteProduct('.$arrData[$i]['productoId'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
            </div>';
        }
        // Convertir a formato JSON y enviar la respuesta
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        // Finalizar el proceso
        exit();
    }
    
    public function setProducto(){
        if($_POST){
            

            if(empty($_POST['nombre']) || empty($_POST['categoria']) || empty($_POST['txtprecio']))
            {
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                
                $idProducto = intval($_POST['idProducto']);
                $intCodigo = strClean($_POST['codigo']);
                $strNombre = strClean($_POST['nombre']);
                $strDescripcion = ($_POST['descripcion']);
                $intCategoriaId = intval($_POST['categoria']);
                $strPrecio = strClean($_POST['txtprecio']);
                $intStock = intval($_POST['cantidad']);
                $strModelo = strClean($_POST['modelo']);
                $strColor = strClean($_POST['color']);
                $strCapacidad = strClean($_POST['capacidad']);
                $intEstado = intval($_POST['estado']);
                
                $request_producto = "";
            

                if($idProducto === 0 || $idProducto === "")
                {
                    $option = 1;
                    $request_producto = $this->model->insertProducto($idProducto, $intCodigo, $strNombre, $strDescripcion, $intCategoriaId, $strPrecio, $intStock, $strModelo, $strColor, $strCapacidad, $intEstado);
                }else{
                    $option = 2;
                    $request_producto = $this->model->updateProducto($idProducto, $intCodigo, $strNombre, $strDescripcion, $intCategoriaId, $strPrecio, $intStock, $strModelo, $strColor, $strCapacidad, $intEstado);
                }
                if($request_producto > 0)
                {
                    if($option == 1){
                        $arrResponse = array('status' => true, 'idProducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
                    }else{
                        $arrResponse = array('status' => true, 'idProducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
                    }
                }else if($request_producto == 'exist'){
                    $arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');		
                }else{
                    $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
               
            exit();
        }
    }

    
    public function getProducto($idproducto){
            $idproducto = intval($idproducto);
            if($idproducto > 0){
                $arrData = $this->model->selectProducto($idproducto);
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrImg = $this->model->selectImages($idproducto);
                    if(count($arrImg) > 0){
                        for ($i=0; $i < count($arrImg); $i++) { 
                            $arrImg[$i]['url_image'] = media().'/img/uploads/'.$arrImg[$i]['imagen'];
                        }
                    }
                    $arrData['images'] = $arrImg;
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
        exit();
    }

    // Controlador para obtener el código desde la base de datos
    public function getCodigo($codigo) {
        $codigo = intval($codigo);
        if ($codigo > 0) {
            $arrData = $this->model->getCodigo($codigo);
            // Devuelve los datos del código si existen
            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        // Maneja el caso en el que no se encuentra el código
        exit();
}

    public function setImage(){
        if($_POST){
            if(empty($_POST['idProducto'])){
                 $arrResponse = array('status' => false, 'msg' => 'Error de dato.');
            }else{
                $idProducto = intval($_POST['idProducto']);
                $foto = $_FILES['foto'];
                $imgNombre = 'producto_'.md5(date('d-m-Y H:m:s')).'.jpg';
                $request_image = $this->model->insertImage($idProducto,$imgNombre);
                if($request_image){
                    $uploadImage = uploadImage($foto,$imgNombre);
                    $arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error de carga.');
                }
            }
            sleep(2);
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    public function delFile(){
        if($_POST){
            if(empty($_POST['idProducto']) || empty($_POST['file'])){
                $arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
            }else{
                //Eliminar de la DB
                $idProducto = intval($_POST['idProducto']);
                $imgNombre  = strClean($_POST['file']);
                $request_image = $this->model->deleteImage($idProducto,$imgNombre);

                if($request_image){
                    $deleteFile =  deleteFile($imgNombre);
                    $arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        exit();
    }

    public function delProducto($idProducto){
        if (isset($_POST['idProducto'])) {
            $intIdProducto = $_POST['idProducto'];
            $requestDelete = $this->model->deleteProducto($intIdProducto);
            if ($requestDelete === "ok") {
                $arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
            } else if ($requestDelete === "exist") {
                $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el producto...');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
            }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
   
?>