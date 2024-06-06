<?php 
class categoriasModel extends Mysql
{
    public $intIdcategoria;
    public $strCat;
    public $strDescripcion;
    public $intStatus;
    public $strPortada;


    public function __construct()
    {
     parent::__construct();
    }

    //funcion para consultar todos
    public function selectCategorias()
    {
        $query = "SELECT * FROM categoria WHERE categoriaId != 0 ORDER BY categoriaId ASC";
        $request = $this->searchAll($query);
        return $request;
    }
    //funcion para seleccionar uno
    public function selectOneCategoria(int $id){
        $this->intIdcategoria = $id;
        $sql = "SELECT * FROM categoria WHERE categoriaId = $this->intIdcategoria";
        $request = $this->search($sql);
        return $request;
    }    
    //Insertar
    public function insertCategoria(string $nombreCat, string $descripcion, int $estatus, string $portada)
    {
        $retornar = "";
        $this->strCat = $nombreCat;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $estatus;
        $this->strPortada = $portada;

        $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCat}'";
        $request = $this->searchAll($sql);

        if(empty($request)){
            $query_insert = "INSERT INTO categoria (nombre, descripcion, estadoId, portada) VALUES (?, ?, ?, ?)";
            $arrData = array($this->strCat, $this->strDescripcion, $this->intStatus, $this->strPortada);
            $request_insert = $this->insert($query_insert, $arrData);
            $retornar = $request_insert;
        }else{
            $retornar = "exist";
        }
        return $retornar;
    }
    //Actualizar
    public function updateCategoria(int $idcategoria, string $categoria, string $descripcion, string $portada, int $status){
        $this->$intIdcategoria = $idcategoria;
        $this->strCat = $nombreCat;
        $this->strDescripcion = $descripcion;
        $this->intStatus = $estatus;
        $this->strPortada = $portada;

        $sql = "SELECT * FROM categoria WHERE nombre = '{$this->strCat}' AND categoriaId != $this->intIdcategoria";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $sql = "UPDATE categoria SET nombre = ?, descripcion = ?, status = ?, portada = ? WHERE categoriaId = $this->intIdcategoria ";
            $arrData = array($this->strCat, $this->strDescripcion, $this->intStatus, $this->strPortada);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }
}










?>