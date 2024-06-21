<?php 
class PermisosModel extends Mysql
{
    public $intIdpermiso;
		public $rolId;
		public $moduloId;
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
        $sql = "SELECT * FROM modulo WHERE estado = 1";
        $request = $this->searchAll($sql);
        return $request;
    }

    public function searchPermisosRol(int $idrol)
    {
        $this->rolId = $idrol;
        $sql = "SELECT * FROM permiso WHERE rolId = $this->rolId";
        $request = $this->searchAll($sql);
        return $request;
    }

    public function deletePermisosRol(int $idrol){
        $this->rolId = $idrol;
        try {
            $sql = "DELETE FROM permiso WHERE rolId = $this->rolId";
            $request = $this->delete($sql);
            return $request;
        } catch (Exception $e) {
            
            return $e->getMessage();
        }
    }


    public function insertPermisosRol(int $idrol, int $moduloId, int $lectura, int $escritura, int $actualizar,int $eliminar ){
        
       
        $this->rolId = $idrol;
        $this->moduloId = $moduloId;
        $this->lectura = $lectura;
        $this->escritura = $escritura;
        $this->actualizar = $actualizar;
        $this->eliminar = $eliminar;
        $query = "INSERT INTO permiso(rolId, moduloId, lectura, escritura, actualizar,eliminar) VALUES(?,?,?,?,?,?)";
        $arrData = array($this->rolId, $this->moduloId, $this->lectura, $this->escritura, $this->actualizar, $this->eliminar);
        $request = $this->insert($query, $arrData);
        return $request;
    }
}
?>