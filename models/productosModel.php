<?php 
    class ProductosModel extends Mysql{

        private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCategoriaId;
		private $intPrecio;
		private $intcantidad;
		private $intStatus;
		private $strImagen;

        public function __construct()
        {
            parent::__construct();
        }


        //funcion para consultar todos
        public function selectProductos(){
            $query = "SELECT p.productoId, c.categoriaId, c.nombre as categoria, p.nombre, p.descripcion, p.precio, p.cantidad, p.creado, p.estado FROM producto p INNER JOIN categoria c ON p.categoriaId = c.categoriaId WHERE p.estado != 0";
            $request = $this->select_all($query);
            return $request;
        }


		public function insertProducto(int $idProducto, string $nombre, string $descripcion, int $categoriaid, string $precio, int $cantidad, int $status){
			$this->intIdProducto = $idProducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intcantidad = $cantidad;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(categoriaId, nombre, descripcion, precio, cantidad, estado) VALUES(?,?,?,?,?,?)";
				$arrData = array($this->intCategoriaId, $this->strNombre, $this->strDescripcion, $this->strPrecio, $this->intcantidad, $this->intStatus);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $categoriaid, string $precio, int $cantidad, int $status){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intcantidad = $cantidad;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto SET nombre=?, descripcion=?, precio=?, cantidad=?, estado=?  WHERE productoId = $this->intIdProducto ";
				$arrData = array($this->strNombre, $this->strDescripcion, $this->strPrecio, $this->intcantidad, $this->intStatus);
				$request = $this->update($sql,$arrData);
				$return = $request;
			}else{
				$return = "exist";
			}
			return $return;
		}

		public function insertImage(int $idProducto, string $imagen){
			$this->intIdProducto = $idProducto;
			$this->strImagen = $imagen;
			$query_insert = "INSERT INTO imagen(productoId, imagen) VALUES(?,?)";
			$arrData = array($this->intIdProducto, $this->strImagen);
			$request_insert = $this->insert($query_insert, $arrData);
			return $request_insert;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.productoId, c.categoriaId, c.nombre as categoria,  p.nombre, p.descripcion, p.precio, p.cantidad, p.estado FROM producto p INNER JOIN categoria c ON p.categoriaid = c.categoriaId WHERE productoId = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoId, imagen FROM imagen WHERE productoId = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}
    }
?>