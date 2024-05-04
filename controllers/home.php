<?php 
    class Home extends Controllers{
        public function __construct(){
           //ejecutar el constructor del controlador
            parent::__construct();
        }
        public function metodo($params){
            echo "Hola desde el controlador Hom";
    }

        public function carrito($params){
            $carrito = $this->model->getCarrito($params);
            echo $carrito;
        }

    }

?>