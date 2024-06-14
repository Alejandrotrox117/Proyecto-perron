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

            if($intidCategoria == '' || $intidCategoria == 0){
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
                //condicion para cambiar la foto al actualizar
                if($nombre_foto == ''){
                    if($_POST['foto_actual'] != 'categorias.png' && $_POST['foto_remove'] == 0){
                        $imgPortada = $_POST['foto_actual'];
                    }
                }
                if(($nombre_foto == '' && $_POST['foto_remove'] == 1 && $_POST['foto_actual'] != 'categorias.png') || ($nombre_foto != '' && $_POST['foto_actual'] != 'categorias.png')){
                    deleteFile($_POST['foto_actual']);
                }
                $request_categoria = $this->model->updateCategoria($intidCategoria, $strNombre, $strDescripcion, $intStatus, $imgPortada);
                if(is_numeric($request_categoria) && $request_categoria > 0){
                    $arrResponse = array('status' => true, 'msg' => 'Datos actualizados correctamente.');
                    if($nombre_foto != ''){uploadImage($foto, $imgPortada);}
                }else if($request_categoria === "exist"){
                    $arrResponse = array('status' => false, 'msg' => 'Categoria ya existe.');
                }else{
                    $arrResponse = array('status' => false, 'msg' => 'No es posible actualizar los datos.');
                }
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
                die();
            }
        }
    }

    public function getCategoria(){
        $arrData = $this->model->selectCategorias();

        for ($i=0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estado'] == 1) {
                $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['acciones'] = '<div class="text-center">
            <button class="btn btn-warning btn-sm" onClick="btnViewInfo('.$arrData[$i]['categoriaId'].')" title="Ver"><i class="fas fa-eye"></i></button>
            <button class="btn btn-warning btn-sm" onClick="btnEditInfo(this,'.$arrData[$i]['categoriaId'].')" title="Editar"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onClick="btnDelInfo('.$arrData[$i]['categoriaId'].')" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
            </div>';
        }

        // Convertir a formato JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        // Finalizar el proceso
        exit();
    }

    public function getAcategoria(int $idCategoria){
        if(isset($idCategoria)){
            $intidCategoria = intval($idCategoria);
            if($intidCategoria > 0){
                $arrData = $this->model->selectOneCategoria($intidCategoria);
                if(empty($arrData)){
                    $arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
                }else{
                    $arrData['url_portada'] = media().'/img/uploads/'.$arrData['portada'];
                    $arrResponse = array('status' => true, 'data' => $arrData);
                }
                echo json_encode($arrData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ;    
            }
            die();
        }
    }

    public function delCategoria($idCategoria){
        if($_POST['idCategoria']){
            $intIdcategoria = $_POST['idCategoria'];
			$requestDelete = $this->model->deleteCategoria($intIdcategoria);
				if($requestDelete = 'ok'){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado la categoría');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar una categoría con productos asociados.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar la categoría.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		    die();
	}

    public function getSelectCategorias(){
        $arrData = $this->model->selectCategorias();
        $options = "";
        if(count($arrData) > 0){
            for($i=0; $i < count($arrData); $i++){
                if($arrData[$i]['estado'] == 1){
                    $options .= '<option value="'.$arrData[$i]['categoriaId'].'">'.$arrData[$i]['nombre'].'</option>';
                }
            }
            echo $options;
			die();
        }

	}

}
   
?>