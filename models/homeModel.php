<?php
class HomeModel extends mysql {
    public function __construct() {
        parent::__construct();
    }


    //en este modelo se declaran funciones para el crud de productos
    //agregar un producto
    public function setProduct(string $nombre,string $descripcion,int $categoriaId,int $estado,float $precio,int $stock) {
        $queryInsert = "INSERT INTO productos(nombre, descripcion, categoriaId, estado, precio, stock) VALUES (?, ?, ?, ?, ?, ?)";
        $arrayData = array($nombre, $descripcion, $categoriaId, $estado, $precio, $stock);
        $requestInsert = $this->insert($queryInsert, $arrayData);
        return $requestInsert;
    }

    //obtener un producto
    public function getProduct($id) {
        $query = "SELECT * FROM productos WHERE productosId = $id";
        // Invoca el método search() de la clase Mysql
        $request = $this->search($query);
        return $request; // Devuelve el resultado de la consulta
    }

    //actualizar un producto
    public function updateProduct(int $id,string $nombre,string $descripcion,int $categoriaId,int $estado,float $precio,int $stock) {
        $query = "UPDATE productos SET nombre = ?, descripcion = ?, categoriaId = ?, estado = ?, precio = ?, stock = ? WHERE productosId = $id";
        $arrayData = array($nombre, $descripcion, $categoriaId, $estado, $precio, $stock);
       //invoca el metodo uptate() de la clase Mysql
        $request = $this->update($query, $arrayData);
        return $request;
    }

    //obtener todos los productos
    public function get_products() {
        $query = "SELECT * FROM productos";
        $request = $this->searchAll($query);
        return $request;
    }

    //eliminar un producto
    public function deleteProduct($id) {
        $query = "DELETE FROM productos WHERE productosId = $id";
        $request = $this->delete($query);
        return $request;
    }
    
}
?>