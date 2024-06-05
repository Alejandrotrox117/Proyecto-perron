<?php
class Roles extends Controllers 
{
    public $intIdRol;
    public  $id;
    public  $rol;
    public $descripcion;
    public $estatus;

    public function __construct()
    {
        parent::__construct();
    }


    public function roles($params)
    {
        $data['page_id'] = 4;
        $data['page_tag'] = "Roles de Usuarios";
        $data['page_title'] = "Roles de Usuarios";
        $data['page_name'] = "Roles de usuarios";

        $this->views->getView($this, "roles", $data);
    }

    //Obtener un solo rol
    public function getOneRol(int $id){
        $intIdRol= intval(strClean($id));
        if($intIdRol > 0){
            $arrData = $this->model->selectOneRol($intIdRol);
            if(empty($arrData)){
                $arrResponse = array('status' => false, 'msg' => 'Rol no encontrado');
            }else{
                $arrResponse = array('status' => true, 'data' => $arrData);
            }
            //convertir en formato json
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }






    // Obtener todos los roles
    public function getRoles()
    {
        $arrData = $this->model->selectRoles();

        for ($i=0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estatus'] == 1) {
                $arrData[$i]['estatus'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estatus'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['acciones'] = '<div class="text-center">
            <button class="btn btn-warning btn-sm btnEditRol" rl="'.$arrData[$i]['rol_id'].'" title="Editar"><i class="fas fa-edit"></i></button>
            <button class="btn btn-info btn-sm btnPermisos" rl="'.$arrData[$i]['rol_id'].'" title="Permisos"><i class="fas fa-key"></i></button>
            <button class="btn btn-danger btn-sm btnEliRol" rl="'.$arrData[$i]['rol_id'].'" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </div>';
        }

        // Convertir a formato JSON
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        // Finalizar el proceso
        exit();
    }

    // Crear un nuevo rol
            public function setRol(){
            $intIdRol = intval($_POST['idRol']);
            $rol = strClean($_POST['txtRol']);
            $descripcion = strClean($_POST['txtDescripcion']);
            $estatus = intval($_POST['listEstatus']);
            $request_rol = $this->model->insertRol($rol, $estatus, $descripcion);

            $arrResponse = [];

            
            if($intIdRol == 0){
                //crear
                $request_rol = $this->model->insertRol($rol, $estatus, $descripcion);
                $option = 1;
            } else {
                $request_rol = $this->model->updateRol($intIdRol, $rol, $estatus, $descripcion);
                $option = 2;
            }

            if ($request_rol > 0) {
                if($option == 1){
                    $arrResponse = array('status' => true, 'msg' => 'Se ha registrado el rol correctamente.');
                }else{
                    $arrResponse = array('status' => true, 'msg' => 'Se ha actualizado el rol correctamente.');
                }
                $arrResponse['status'] = true;
                $arrResponse['msg'] = '¡Se ha registrado el rol correctamente!';
            } elseif ($request_rol === 'exist') {
                $arrResponse['status'] = false;
                $arrResponse['msg'] = '¡Atención! El rol ya existe.';
            } else {
                $arrResponse['status'] = false;
                $arrResponse['msg'] = 'No es posible registrar el rol.';
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            exit();
        }
        
}

?>