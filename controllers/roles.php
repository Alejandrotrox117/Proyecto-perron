<?php
class Roles extends Controllers
{

    public $introlId;
    public $id;
    public $rol;
    public $descripcion;
    public $estatus;

    public function __construct()
    {
        parent::__construct();
        $this->model = new rolesModel();

    }

    // Método getter para obtener el valor de $model
    public function getModel()
    {
        return $this->model;
    }

    // Método setter para establecer el valor de $model
    public function setModel(rolesModel $model)
    {
        $this->model = $model;
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
    public function getOneRol(int $id)
    {
        $introlId = intval(strClean($id));
        if ($introlId > 0) {
            $arrData = $this->model->selectOneRol($introlId);
            if (empty($arrData)) {
                $arrResponse = array('status' => false, 'msg' => 'Rol no encontrado');
            } else {
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

        for ($i = 0; $i < count($arrData); $i++) {
            if ($arrData[$i]['estado'] == 1) {
                $arrData[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            } else {
                $arrData[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $arrData[$i]['acciones'] = '<div class="text-center">
            <button class="btn btn-warning btn-sm btnEditRol" rl="' . $arrData[$i]['rolId'] . '" title="Editar"><i class="fas fa-edit"></i></button>
            <button class="btn btn-info btn-sm btnPermisos" rl="' . $arrData[$i]['rolId'] . '" title="Permisos"><i class="fas fa-key"></i></button>
            <button class="btn btn-danger btn-sm btnEliRol" rl="' . $arrData[$i]['rolId'] . '" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                </div>';
        }

        // Convertir a formato JSON

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        // Finalizar el proceso
        exit();
    }

    // public function setRol(){

    //         $rol = strClean($_POST['txtRol']);
    //         $descripcion = strClean($_POST['txtDescripcion']);
    //         $estatus = intval($_POST['listEstatus']);


    //     $intIdrol = intval($_POST['rolId']);
    //     $strRol =  strClean($_POST['txtRol']);
    //     $strDescipcion = strClean($_POST['txtDescripcion']);
    //     $intStatus = intval($_POST['listEstatus']);

    //     if($intIdrol == 0)
    //     {
    //         Crear
    //         $request_rol = $this->model->insertRol($strRol, $intStatus, $strDescipcion);


    //         $option = 1;
    //     }else{
    //         Actualizar
    //         $request_rol = $this->model->updateRol($intIdrol, $strRol, $intStatus,$strDescipcion );
    //         $option = 2;
    //     }

    //     if($request_rol > 0 )
    //     {
    //         if($option == 1)
    //         {
    //             $arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
    //         }else{
    //             $arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
    //         }
    //     }else if($request_rol == 'exist'){

    //         $arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
    //     }else{
    //         $arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
    //     }
    //     var_dump($_POST);
    //     echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
    //     die();
    // }




    //Crear un nuevo rol
    public function setRol()
    {
        $introlId = intval($_POST['rolId']);
        $rol = strClean($_POST['txtRol']);
        $descripcion = strClean($_POST['txtDescripcion']);
        $estatus = intval($_POST['listEstatus']);

        // Verificar si se trata de una actualización o un nuevo rol
        if ($introlId > 0) { // Si $introlId es mayor que 0, es una actualización
            $request_rol = $this->model->updateRol($introlId, $rol, $estatus, $descripcion);
        } else { // Si $introlId es 0, es un nuevo rol
            $request_rol = $this->model->insertRol($rol, $estatus, $descripcion);
        }

        if ($request_rol === false) {
            $arrResponse = array("status" => false, "msg" => 'No es posible registrar el rol.');
        } else if ($request_rol === "exist") {
            $arrResponse = array("status" => false, "msg" => '¡Atención! El rol ya existe.');
        } else {
            $action = ($introlId == 0) ? 'registrado' : 'actualizado';
            $arrResponse = array("status" => true, "msg" => "Se ha $action el rol correctamente.");
        }

        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        exit();
    }







    public function delRol()
    {
        if ($_POST) {
            $introlId = intval($_POST['rolId']);
            $requestDelete = $this->model->deleteRol($introlId);

            if ($requestDelete == "ok") {
                $arrResponse = array('status' => true, 'msg' => '¡Se ha eliminado el rol!');
            } else if ($requestDelete == "exist") {
                $arrResponse = array('status' => false, 'msg' => 'No es posible eliminar el rol asociado a un usuario.');
            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al eliminar el rol.');
            }

            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }
    public function getSelectRoles()
    {
        $htmlOptions = "";
        $arrData = $this->model->selectRoles();
        if (count($arrData) > 0) {
            for ($i = 0; $i < count($arrData); $i++) {
                $htmlOptions .= '<option value="' . $arrData[$i]['rolId'] . '">' . $arrData[$i]['nombre'] . '</option>';
            }
        }
        echo $htmlOptions;
        die();
    }

}



?>