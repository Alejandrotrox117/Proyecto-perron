<?php 
class rolesModel extends Mysql
{
    public function __construct()
    {
     parent::__construct();   
    }

    public function selectRoles() {
        $query = "SELECT * FROM rol WHERE estatus != 0 ";
        // Invoca el método search() de la clase Mysql
        $request = $this->searchAll($query);
        return $request; // Devuelve el resultado de la consulta
    }



}











?>