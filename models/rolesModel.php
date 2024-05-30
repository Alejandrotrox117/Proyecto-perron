<?php 
class rolesModel extends Mysql
{
    public function __construct()
    {
     parent::__construct();   
    }

    public function selectRoles() {
        $query = "SELECT * FROM rol WHERE rol_id != 0 ORDER BY rol_id ASC";
        // Invoca el método search() de la clase Mysql
        $request = $this->searchAll($query);
        return $request; // Devuelve el resultado de la consulta
    }



}











?>