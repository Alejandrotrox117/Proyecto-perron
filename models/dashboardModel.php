<?php 
class dashboardModel extends Mysql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function Cantcategorias()
    {
        $sql = "SELECT COUNT(*) as total FROM categoria WHERE estado != 0";
        $request = $this->search($sql);
        $total = $request['total'];
        return $total;
    }
    public function Cantrol()
    {
        $sql = "SELECT COUNT(*) as total FROM rol WHERE estado != 0";
        $request = $this->search($sql);
        $total = $request['total'];
        return $total;
    }
    public function UltimasOrdes(){
        $sql = "SELECT p.solicitudId, CONCAT(pr.nombres, ' ', pr.apellidos) as nombre, p.precio, p.estado FROM solicitud p INNER JOIN persona pr ON p.personaId = pr.personaId ORDER BY p.solicitudId DESC LIMIT 10;
        ";
        $request = $this->searchAll($sql);
        return $request;
    }
}
?>
