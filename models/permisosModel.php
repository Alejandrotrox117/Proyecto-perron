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
}
?>