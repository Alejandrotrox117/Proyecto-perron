<?php
class HomeModel extends mysql {
    public function __construct() {
        parent::__construct();
    }

    public function setProduct(string $nombre,string $descripcion,int $categoriaId,int $estadoId,float $precio,int $stock) {
        $queryInsert = "INSERT INTO productos(nombre, descripcion, categoriaId, estadoId, precio, stock) VALUES (?, ?, ?, ?, ?, ?)";
        $arrayData = array($nombre, $descripcion, $categoriaId, $estadoId, $precio, $stock);
        $requesInsert = $this->insert($queryInsert, $arrayData);
        return $requesInsert;
    }

    public function getProduct($id) {
        $query = "SELECT * FROM productos WHERE productosId = $id";
        // Invoca el método search() de la clase Mysql
        $request = $this->search($query);
        return $request; // Devuelve el resultado de la consulta
    }

    
}
?>