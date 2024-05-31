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

    public function getRoles(){
        $arrData = $this->model->selectRoles();

        for ($i=0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estatus'] == 1) {
                $arrData[$i]['estatus'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estatus'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['acciones'] = '<div class="text-center>
            <button class="btn btn-success btn-sm btnEditRol" idRol="'.$arrData[$i]['rol_id'].'" data-toggle="modal" data-target="#modalFormRol" type="button">Success</button>';

        }


        //convertir a formato json
        echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
        //finalizar el proceso
        die();
    }

}   
?>