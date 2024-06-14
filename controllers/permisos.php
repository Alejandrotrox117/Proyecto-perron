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
            $arrayPermiso = array('lectura' => 0, 'escritura' => 0, 'eliminar' => 0, 'actualizar' => 0);
            $arrayRol = array('rolId' => $rolId);

            if (empty($arrayPermisosRol)) {
                for ($i = 0; $i < count($arrayModulos); $i++) {
                    $arrayModulos[$i]['permisos'] = $arrayPermiso;
                }
            } else {
                for ($i = 0; $i < count($arrayModulos); $i++) {
                    // utilizamos isset para verificar si existen los indices de los permisos
                    if (isset($arrayPermisosRol[$i]) && isset($arrayPermisosRol[$i]['lectura']) && isset($arrayPermisosRol[$i]['escritura']) && isset($arrayPermisosRol[$i]['eliminar']) && isset($arrayPermisosRol[$i]['actualizar'])) {
                        $arrayPermiso = array(
                            'lectura' => $arrayPermisosRol[$i]['lectura'],
                            'escritura' => $arrayPermisosRol[$i]['escritura'],
                            'eliminar' => $arrayPermisosRol[$i]['eliminar'],
                            'actualizar' => $arrayPermisosRol[$i]['actualizar']
                        );

                        if ($arrayModulos[$i]['idmodulo'] == $arrayPermisosRol[$i]['idmodulo']) {
                            $arrayModulos[$i]['permisos'] = $arrayPermiso;
                            $arrayModulos[$i]['idmodulo'] = $arrayPermisosRol[$i]['idmodulo']; // Agregamos el ID del módulo
                        }
                    }
                }
            }

            $arrayRol['modulos'] = $arrayModulos;
            $html = getModal('modalPermisos', $arrayRol);
        }

        exit();
    }

    public function setPermisos()
    {
        if(isset($_POST)){
        $intIdRol = intval($_POST['idRol']);
        $modulos = $_POST['modulos'];
        $this->model->deletePermisosRol($intIdRol);
        foreach($modulos as $modulo){
            $intIdModulo = intval($modulo['idmodulo']);
            $lectura =empty($modulo['lectura']) ? 0 : 1;
            $escritura = empty($modulo['escritura']) ? 0 : 1;
            $eliminar = empty($modulo['eliminar']) ? 0 : 1;
            $actualizar = empty($modulo['actualizar']) ? 0 : 1;
            $requestPermiso = $this->model->insertPermisosRol($intIdRol, $intIdModulo, $lectura, $escritura, $eliminar, $actualizar);
        }
        if ($requestPermiso > 0) {
            $arrResponse = array('status' => true, 'msg' => 'Permisos guardados correctamente.');
        } else {
            $arrResponse = array('status' => false, 'msg' => 'No se guardaron los permisos.');
        }
            echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        }
        exit();
    }
}

?>