<?php 
class PermisosModel extends Mysql
{
    public $intIdpermiso;
		public $rolId;
		public $idModulo;
		public $lectura;
		public $escritura;
		public $actualizar;
		public $eliminar;
    public function __construct()
    {
        parent::__construct();
    }

    // Obtenemos todos los módulos
    public function searchModulos()
    {
        $sql = "SELECT * FROM modulo WHERE estatus = 1";
        $request = $this->searchAll($sql);
        return $request;
    }

    public function searchPermisosRol(int $idrol)
    {
        $this->rolId = $idrol;
        $sql = "SELECT * FROM permisos WHERE rol_id = $this->rolId";
        $request = $this->searchAll($sql);
        return $request;
    }

    public function deletePermisosRol(int $idrol){
        $this->rolId = $idrol;
        try {
            $sql = "DELETE FROM permisos WHERE rol_id = $this->rolId";
            $request = $this->delete($sql);
            return $request;
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
    }


    public function insertPermisosRol(int $idrol, int $idmodulo, int $lectura, int $escritura, int $eliminar, int $actualizar){

        $this->rolId = $idrol;
        $this->idModulo = $idmodulo;
        $this->lectura = $lectura;
        $this->escritura = $escritura;
        $this->actualizar = $actualizar;
        $this->eliminar = $eliminar;
        $query = "INSERT INTO permisos(rol_id, idmodulo, lectura, escritura, eliminar,actualizar) VALUES(?,?,?,?,?,?)";
        $arrData = array($this->rolId, $this->idModulo, $this->lectura, $this->escritura, $this->actualizar, $this->eliminar);
        $request = $this->insert($query, $arrData);
        return $request;
    }
}
?>