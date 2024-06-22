<?php 
    class ProductosModel extends Mysql{

        private $intIdProducto;
		private $intCodigo;
		private $strNombre;
		private $strDescripcion;
		private $intCategoriaId;
		private $strPrecio;
		private $intcantidad;
		private $strModelo;
		private $strColor;
		private $strCapacidad;
		private $intStatus;
		private $strImagen;

        public function __construct()
        {
            parent::__construct();
        }


        //funcion para consultar todos
        public function selectProductos(){
            $query = "SELECT p.productoId, c.categoriaId, p.codigo, c.nombre as categoria, p.nombre, p.descripcion, p.precio, p.cantidad, p.modelo, p.color, p.capacidad, p.creado, p.estado FROM producto p INNER JOIN categoria c ON p.categoriaId = c.categoriaId";
            $request = $this->select_all($query);
            return $request;
        }

		//Agregar
		public function insertProducto(int $idProducto, int $codigo, string $nombre, string $descripcion, int $categoriaid, string $precio, int $cantidad, string $modelo, string $color, string $capacidad, int $status){
			$this->intIdProducto = $idProducto;
			$this->intCodigo = $codigo;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intcantidad = $cantidad;
			$this->strModelo = $modelo;
			$this->strColor = $color;
			$this->strCapacidad = $capacidad;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(categoriaId, codigo, nombre, descripcion, precio, cantidad, modelo, color, capacidad, estado) VALUES(?,?,?,?,?,?,?,?,?,?)";
				$arrData = array($this->intCategoriaId, $this->intCodigo, $this->strNombre, $this->strDescripcion, $this->strPrecio, $this->intcantidad, $this->strModelo, $this->strColor, $this->strCapacidad, $this->intStatus);
				$request_insert = $this->insert($query_insert,$arrData);
				$return = $request_insert;
			}else{
				$return = "exist";
			}
			return $return;
		}

		//Actualizar
		public function updateProducto(int $idProducto, int $codigo, string $nombre, string $descripcion, int $categoriaid, string $precio, int $cantidad, string $modelo, string $color, string $capacidad, int $status){
			$this->intIdProducto = $idProducto;
			$this->intCodigo = $codigo;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intcantidad = $cantidad;
			$this->strModelo = $modelo;
			$this->strColor = $color;
			$this->strCapacidad = $capacidad;
			$this->intStatus = $status;

			$return = 0;
			$sql = "SELECT * FROM producto WHERE nombre = '{$this->strNombre}' AND productoId != '{$this->intIdProducto}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{  
				$sql = "UPDATE producto SET categoriaId = ?, codigo = ?, nombre = ?, descripcion = ?, precio = ?, cantidad = ?, modelo = ?, color = ?, capacidad = ?, estado = ? WHERE productoId = '{$this->intIdProducto}'";
				$arrData = array(
					$this->intCategoriaId,
					$this->intCodigo,
					$this->strNombre,
					$this->strDescripcion,
					$this->strPrecio,
					$this->intcantidad,
					$this->strModelo,
					$this->strColor,
					$this->strCapacidad,
					$this->intStatus,
				);
				$request = $this->update($sql,$arrData);
				$return = $request;
			}else{
				$return = "exist";
			}
			return $return;
		}

		//Eliminar
		public function deleteProducto(int $idProducto){
			$this->intIdProducto = $idProducto;
				$sql = "DELETE FROM producto WHERE productoId = '{$this->intIdProducto}'";	
				$request = $this->delete($sql);
	
				if ($request){
					return "ok";
				}else{
					return "Error";
				}
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
			$sql = "SELECT p.productoId, c.categoriaId, c.nombre as categoria, p.codigo,  p.nombre, p.descripcion, p.precio, p.cantidad, p.modelo, p.color, p.capacidad, p.estado FROM producto p INNER JOIN categoria c ON p.categoriaid = c.categoriaId WHERE productoId = $this->intIdProducto";
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