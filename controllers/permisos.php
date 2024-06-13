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
                    //utilizamos isset para verificar si existen los indices de los permisos
                    if (isset($arrayPermisosRol[$i]) && isset($arrayPermisosRol[$i]['lectura']) && isset($arrayPermisosRol[$i]['escritura']) && isset($arrayPermisosRol[$i]['eliminar']) && isset($arrayPermisosRol[$i]['actualizar'])) {
                        $arrayPermiso = array(
                            'lectura' => $arrayPermisosRol[$i]['lectura'],
                            'escritura' => $arrayPermisosRol[$i]['escritura'],
                            'eliminar' => $arrayPermisosRol[$i]['eliminar'],
                            'actualizar' => $arrayPermisosRol[$i]['actualizar']
                        );

                        if ($arrayModulos[$i]['idmodulo'] == $arrayPermisosRol[$i]['idmodulo']) {
                            $arrayModulos[$i]['permisos'] = $arrayPermiso;
                        }
                       
                    }
                    
                }
                
            }
            $arrayRol['modulos'] = $arrayModulos;
            $html = getModal('modalPermisos', $arrayRol);
        }

        exit();
    }
}
?>