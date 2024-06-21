<?php
class Permisos extends Controllers
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPermisos(int $id)
    {
        $rolId = intval($id);
        if ($rolId > 0) {
            $arrayModulos = $this->model->searchModulos();
            $arrayPermisosRol = $this->model->searchPermisosRol($rolId);
            $arrayPermiso = array('lectura' => 0, 'escritura' => 0, 'actualizar' => 0, 'eliminar' => 0);
            $arrayRol = array('rolId' => $rolId);

            if (empty($arrayPermisosRol)) {
                for ($i = 0; $i < count($arrayModulos); $i++) {
                    $arrayModulos[$i]['permiso'] = $arrayPermiso;
                }
            } else {
                for ($i = 0; $i < count($arrayModulos); $i++) {
                    // utilizamos isset para verificar si existen los indices de los permisos
                    if (isset($arrayPermisosRol[$i]) && isset($arrayPermisosRol[$i]['lectura']) && isset($arrayPermisosRol[$i]['escritura']) && isset($arrayPermisosRol[$i]['eliminar']) && isset($arrayPermisosRol[$i]['actualizar'])) {
                        $arrayPermiso = array(
                            'lectura' => $arrayPermisosRol[$i]['lectura'],
                            'escritura' => $arrayPermisosRol[$i]['escritura'],
                            'actualizar' => $arrayPermisosRol[$i]['actualizar'],
                            'eliminar' => $arrayPermisosRol[$i]['eliminar'],

                        );

                        if ($arrayModulos[$i]['moduloId'] == $arrayPermisosRol[$i]['moduloId']) {
                            $arrayModulos[$i]['permiso'] = $arrayPermiso;
                            $arrayModulos[$i]['moduloId'] = $arrayPermisosRol[$i]['moduloId']; // Agregamos el ID del módulo
                        }
                    }
                }
            }

            $arrayRol['modulo'] = $arrayModulos;
            //$html = getModal('modalPermisos', $arrayRol);
        }

        exit();
    }

    public function setPermisos()
    {
        if (!empty($_POST['rolId']) && !empty($_POST['modulo'])) {
            $intRolId = intval($_POST['rolId']);
            $modulos = $_POST['modulo'];
    
            $this->model->deletePermisosRol($intRolId);
    
            $errors = 0;
            $permisosModulo = []; // Array para almacenar el estado de los permisos por módulo
    
            foreach ($modulos as $modulo) {
                $intmoduloId = $modulo['moduloId'];
                $lectura = isset($modulo['lectura']) ? 1 : 0;
                $escritura = isset($modulo['escritura']) ? 1 : 0;
                $actualizar = isset($modulo['actualizar']) ? 1 : 0;
                $eliminar = isset($modulo['eliminar']) ? 1 : 0;
    
                // Utilizar sentencia preparada para insertar permisos
                $requestPermiso = $this->model->insertPermisosRol($intRolId, $intmoduloId, $lectura, $escritura, $actualizar, $eliminar);
    
                if ($requestPermiso === false) {
                    $errors++;
                }
    
                // Almacenar el estado de los permisos para el módulo actual
                $permisosModulo[$intmoduloId] = [
                    'lectura' => $lectura,
                    'escritura' => $escritura,
                    'actualizar' => $actualizar,
                    'eliminar' => $eliminar,
                ];
            }
    
            if ($errors === 0) {
                $arrResponse = array('status' => true, 'msg' => 'Permisos asignados correctamente.', 'permisos' => $permisosModulo);
            } else {
                $arrResponse = array("status" => false, "msg" => 'No es posible asignar los permisos.', 'permisos' => $permisosModulo);
            }
    
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        } else {
            $arrResponse = array("status" => false, "msg" => 'Datos incompletos.');
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
    
        exit();
    }
    

}

?>